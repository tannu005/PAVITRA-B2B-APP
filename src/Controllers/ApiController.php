<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Application;

class ApiController extends Controller {

    public function __construct() {
        $this->checkRateLimit(Application::$app->request, Application::$app->response);
    }

    protected function checkRateLimit(Request $request, Response $response): void {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        if (empty($ip)) return;
        
        $db = Application::$app->db;
        $url = $_SERVER['REQUEST_URI'] ?? '';
        
        try {
            $stmt = $db->prepare("INSERT INTO activity_logs (activity, details, ip_address) VALUES ('API_HIT', ?, ?)");
            $stmt->execute([$url, $ip]);
            
            $stmtCount = $db->prepare("SELECT COUNT(*) FROM activity_logs WHERE ip_address = ? AND created_at >= NOW() - INTERVAL 1 MINUTE");
            $stmtCount->execute([$ip]);
            $count = intval($stmtCount->fetchColumn());
            
            if ($count > 60) {
                $response->setStatusCode(429);
                echo json_encode([
                    'error' => 'Too Many Requests. Rate limit of 60 requests per minute exceeded.',
                    'retry_after' => 60
                ]);
                exit;
            }
        } catch (\Throwable $e) {
        }
    }

    protected function authenticateApi(Request $request, Response $response, array $allowedRoles = []): ?array {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? '';

        if (empty($authHeader) || !str_starts_with($authHeader, 'Bearer ')) {
            $response->setStatusCode(401);
            echo json_encode(['error' => 'Unauthorised. Missing or invalid Bearer token.']);
            exit;
        }

        $token = substr($authHeader, 7);
        $db = Application::$app->db;

        $stmt = $db->prepare("
            SELECT u.*, r.name as role 
            FROM user_sessions us
            JOIN users u ON us.user_id = u.id
            JOIN roles r ON u.role_id = r.id
            WHERE us.token = ? AND u.status = 'ACTIVE'
        ");
        $stmt->execute([$token]);
        $user = $stmt->fetch();

        if (!$user) {
            $response->setStatusCode(401);
            echo json_encode(['error' => 'Unauthorised. Session expired or token revoked.']);
            exit;
        }

        if (!empty($allowedRoles) && !in_array($user['role'], $allowedRoles)) {
            $response->setStatusCode(403);
            echo json_encode(['error' => 'Forbidden. Permission denied.']);
            exit;
        }

        return $user;
    }

    // 1. POST /api/auth/register (User & Profile Registration API)
    public function register(Request $request, Response $response) {
        $body = $request->getBody();
        $name = trim($body['name'] ?? '');
        $email = trim($body['email'] ?? '');
        $mobile = trim($body['mobile'] ?? '');
        $password = $body['password'] ?? '';
        $roleName = strtoupper(trim($body['role_name'] ?? 'RETAILER')); // SELLER, RETAILER, DELIVERY
        $shopCompanyName = trim($body['shop_company_name'] ?? '');

        if (empty($name) || empty($email) || empty($mobile) || empty($password) || empty($shopCompanyName)) {
            return $response->json(['error' => 'Name, email, mobile, password, and company/shop name are required.'], 400);
        }

        if (!in_array($roleName, ['SELLER', 'RETAILER', 'DELIVERY'])) {
            return $response->json(['error' => 'Invalid role selected. Must be SELLER, RETAILER, or DELIVERY.'], 400);
        }

        $db = Application::$app->db;

        try {
            $db->beginTransaction();

            $stmt = $db->prepare("SELECT id FROM users WHERE email = ? OR mobile = ?");
            $stmt->execute([$email, $mobile]);
            if ($stmt->fetch()) {
                $db->rollBack();
                return $response->json(['error' => 'An account with this email or mobile number already exists.'], 400);
            }

            $stmtRole = $db->prepare("SELECT id FROM roles WHERE name = ?");
            $stmtRole->execute([$roleName]);
            $roleId = $stmtRole->fetchColumn();

            if (!$roleId) {
                $db->rollBack();
                return $response->json(['error' => 'Role database record not found.'], 500);
            }

            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $stmtInsert = $db->prepare("
                INSERT INTO users (name, email, mobile, password_hash, role_id, status, is_verified_email, is_verified_mobile) 
                VALUES (?, ?, ?, ?, ?, 'ACTIVE', 1, 1)
            ");
            $stmtInsert->execute([$name, $email, $mobile, $passwordHash, $roleId]);
            $userId = $db->lastInsertId();

            if ($roleName === 'SELLER') {
                $stmtProfile = $db->prepare("INSERT INTO seller_profiles (user_id, company_name, commission_rate, balance) VALUES (?, ?, 8.50, 0.00)");
                $stmtProfile->execute([$userId, $shopCompanyName]);
            } else if ($roleName === 'RETAILER') {
                $stmtProfile = $db->prepare("INSERT INTO retailer_profiles (user_id, shop_name, credit_limit, balance) VALUES (?, ?, 50000.00, 0.00)");
                $stmtProfile->execute([$userId, $shopCompanyName]);
            } else if ($roleName === 'DELIVERY') {
                $stmtProfile = $db->prepare("INSERT INTO delivery_partner_profiles (user_id, vehicle_type, is_online, balance) VALUES (?, 'Bike/Scooter', 1, 0.00)");
                $stmtProfile->execute([$userId]);
            }

            $stmtWallet = $db->prepare("INSERT INTO wallets (user_id, balance) VALUES (?, 0.00)");
            $stmtWallet->execute([$userId]);

            $token = bin2hex(random_bytes(32));
            $ip = $_SERVER['REMOTE_ADDR'] ?? '';
            $agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Mobile-App';
            $stmtSession = $db->prepare("INSERT INTO user_sessions (user_id, token, ip_address, user_agent) VALUES (?, ?, ?, ?)");
            $stmtSession->execute([$userId, $token, $ip, $agent]);

            $db->commit();

            return $response->json([
                'success' => true,
                'token' => $token,
                'user' => [
                    'id' => $userId,
                    'name' => $name,
                    'email' => $email,
                    'role' => $roleName
                ]
            ]);

        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'API Registration failed: ' . $e->getMessage()], 500);
        }
    }

    // 2. POST /api/auth/login (Centralized Login API)
    public function login(Request $request, Response $response) {
        $body = $request->getBody();
        $email = trim($body['email'] ?? '');
        $password = $body['password'] ?? '';

        if (empty($email) || empty($password)) {
            return $response->json(['error' => 'Email and password are required.'], 400);
        }

        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT u.*, r.name as role FROM users u JOIN roles r ON u.role_id = r.id WHERE u.email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            if ($user['status'] !== 'ACTIVE') {
                return $response->json(['error' => 'Your merchant account status is pending or blocked.'], 403);
            }

            $token = bin2hex(random_bytes(32));
            
            $ip = $_SERVER['REMOTE_ADDR'] ?? '';
            $agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Mobile-App';
            $stmtSession = $db->prepare("INSERT INTO user_sessions (user_id, token, ip_address, user_agent) VALUES (?, ?, ?, ?)");
            $stmtSession->execute([$user['id'], $token, $ip, $agent]);

            return $response->json([
                'success' => true,
                'token' => $token,
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ]
            ]);
        }

        return $response->json(['error' => 'Invalid credentials.'], 401);
    }

    // 3. GET /api/categories (Fetch Catalog Categories List)
    public function getCategories(Request $request, Response $response) {
        $db = Application::$app->db;
        $stmt = $db->query("SELECT id, name, slug, description, image_url FROM categories ORDER BY id ASC");
        $categories = $stmt->fetchAll() ?: [];
        return $response->json($categories);
    }

    // 4. GET /api/products (Fetch Catalog approved items)
    public function getProducts(Request $request, Response $response) {
        $db = Application::$app->db;
        $stmt = $db->query("
            SELECT p.id, p.title, p.description, c.name as category_name, 
                   pv.id as variant_id, pv.sku, pv.color, pv.size, pv.price, pv.wholesale_price, pv.bulk_threshold, pv.stock, pv.image_url
            FROM products p
            JOIN product_variants pv ON pv.product_id = p.id
            JOIN categories c ON p.category_id = c.id
            WHERE p.status = 'ACTIVE' AND p.is_approved = 1
        ");
        $products = $stmt->fetchAll() ?: [];
        return $response->json($products);
    }

    // 5. GET /api/inventory (For Sellers / Weavers to monitor stock)
    public function getInventory(Request $request, Response $response) {
        $user = $this->authenticateApi($request, $response, ['SELLER']);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->prepare("
            SELECT pv.id as variant_id, pv.sku, pv.color, pv.size, pv.stock, p.title, c.name as category_name
            FROM product_variants pv
            JOIN products p ON pv.product_id = p.id
            JOIN categories c ON p.category_id = c.id
            WHERE p.seller_id = ?
            ORDER BY pv.id DESC
        ");
        $stmt->execute([$user['id']]);
        $inventory = $stmt->fetchAll() ?: [];
        return $response->json($inventory);
    }

    // 6. POST /api/inventory/update (Seller stock Restocks API)
    public function updateInventory(Request $request, Response $response) {
        $user = $this->authenticateApi($request, $response, ['SELLER']);
        if (!$user) return;

        $body = $request->getBody();
        $variantId = intval($body['variant_id'] ?? 0);
        $absoluteQty = intval($body['stock'] ?? -1); // Set absolute stock count

        if ($variantId <= 0 || $absoluteQty < 0) {
            return $response->json(['error' => 'Variant ID and absolute stock count (>= 0) are required.'], 400);
        }

        $db = Application::$app->db;
        
        $stmt = $db->prepare("
            SELECT pv.id, pv.stock FROM product_variants pv 
            JOIN products p ON pv.product_id = p.id 
            WHERE pv.id = ? AND p.seller_id = ?
        ");
        $stmt->execute([$variantId, $user['id']]);
        $variant = $stmt->fetch();

        if (!$variant) {
            return $response->json(['error' => 'Product variant not found or access denied.'], 403);
        }

        try {
            $db->beginTransaction();

            $diff = $absoluteQty - intval($variant['stock']);
            $type = $diff >= 0 ? 'IN' : 'OUT';

            $stmtUpdate = $db->prepare("UPDATE product_variants SET stock = ? WHERE id = ?");
            $stmtUpdate->execute([$absoluteQty, $variantId]);

            $stmtLog = $db->prepare("
                INSERT INTO inventory_logs (product_variant_id, type, quantity, reason) 
                VALUES (?, ?, ?, 'Mobile App API Stock Adjustment')
            ");
            $stmtLog->execute([$variantId, $type, abs($diff)]);

            $db->commit();
            return $response->json(['success' => true, 'new_stock' => $absoluteQty]);

        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'Failed to update stock: ' . $e->getMessage()], 500);
        }
    }

    // 7. GET /api/orders (Fetch user specific orders log)
    public function getOrders(Request $request, Response $response) {
        $user = $this->authenticateApi($request, $response);
        if (!$user) return;

        $db = Application::$app->db;

        if ($user['role'] === 'SELLER') {
            $stmt = $db->prepare("SELECT * FROM orders WHERE seller_id = ? ORDER BY id DESC");
            $stmt->execute([$user['id']]);
        } else {
            $stmt = $db->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC");
            $stmt->execute([$user['id']]);
        }

        $orders = $stmt->fetchAll() ?: [];

        foreach ($orders as &$order) {
            $stmtItems = $db->prepare("
                SELECT oi.quantity, oi.price, oi.wholesale_price, pv.image_url, p.title
                FROM order_items oi
                JOIN product_variants pv ON oi.product_variant_id = pv.id
                JOIN products p ON pv.product_id = p.id
                WHERE oi.order_id = ?
            ");
            $stmtItems->execute([$order['id']]);
            $order['items'] = $stmtItems->fetchAll() ?: [];
        }

        return $response->json($orders);
    }

    // 8. POST /api/orders/create (B2B Checkout Purchase API)
    public function createOrder(Request $request, Response $response) {
        $user = $this->authenticateApi($request, $response, ['RETAILER']);
        if (!$user) return;

        $body = $request->getBody();
        $variantId = intval($body['variant_id'] ?? 0);
        $qty = intval($body['quantity'] ?? 0);
        $address = trim($body['address'] ?? '');

        if ($variantId <= 0 || $qty <= 0 || empty($address)) {
            return $response->json(['error' => 'Variant ID, Quantity, and Shipping Address are required.'], 400);
        }

        $db = Application::$app->db;

        $stmtVar = $db->prepare("
            SELECT pv.*, p.seller_id, p.id as product_id 
            FROM product_variants pv 
            JOIN products p ON pv.product_id = p.id 
            WHERE pv.id = ? AND p.status = 'ACTIVE' AND p.is_approved = 1
        ");
        $stmtVar->execute([$variantId]);
        $variant = $stmtVar->fetch();

        if (!$variant) {
            return $response->json(['error' => 'Product variant not found or not approved.'], 404);
        }

        if ($variant['stock'] < $qty) {
            return $response->json(['error' => "Stock limit exceeded. Only {$variant['stock']} units available."], 400);
        }

        $isWholesale = ($qty >= intval($variant['bulk_threshold']));
        $price = $isWholesale ? floatval($variant['wholesale_price']) : floatval($variant['price']);
        $total = $price * $qty;

        $stmtProfile = $db->prepare("SELECT balance FROM retailer_profiles WHERE user_id = ?");
        $stmtProfile->execute([$user['id']]);
        $balance = floatval($stmtProfile->fetchColumn() ?: 0);

        if ($balance < $total) {
            return $response->json(['error' => 'Insufficient wallet balance. Please refill credit balance.'], 400);
        }

        try {
            $db->beginTransaction();

            $newBalance = $balance - $total;
            $stmtUpRet = $db->prepare("UPDATE retailer_profiles SET balance = ? WHERE user_id = ?");
            $stmtUpRet->execute([$newBalance, $user['id']]);

            $stmtUpWallet = $db->prepare("UPDATE wallets SET balance = ? WHERE user_id = ?");
            $stmtUpWallet->execute([$newBalance, $user['id']]);

            $stmtRetWalletId = $db->prepare("SELECT id FROM wallets WHERE user_id = ?");
            $stmtRetWalletId->execute([$user['id']]);
            $retWalletId = $stmtRetWalletId->fetchColumn();

            $stmtTx = $db->prepare("
                INSERT INTO wallet_transactions (wallet_id, type, amount, description, reference_type, balance_after)
                VALUES (?, 'DEBIT', ?, ?, 'ORDER_PURCHASE', ?)
            ");
            $stmtTx->execute([$retWalletId, $total, "API order purchase for variant SKU: #{$variant['sku']}", $newBalance]);

            $stmtAddr = $db->prepare("INSERT INTO user_addresses (user_id, address_line1, city, state, pin_code) VALUES (?, ?, 'Varanasi', 'UP', '221001')");
            $stmtAddr->execute([$user['id'], $address]);
            $addressId = $db->lastInsertId();

            $orderNumber = 'ORD-' . strtoupper(bin2hex(random_bytes(4))) . '-' . time();
            $stmtOrder = $db->prepare("
                INSERT INTO orders (order_number, user_id, seller_id, status, total_amount, net_amount, payment_status, payment_method, address_id)
                VALUES (?, ?, ?, 'PLACED', ?, ?, 'PAID', 'WALLET', ?)
            ");
            $stmtOrder->execute([$orderNumber, $user['id'], $variant['seller_id'], $total, $total, $addressId]);
            $orderId = $db->lastInsertId();

            $stmtHist = $db->prepare("INSERT INTO order_status_history (order_id, status, comments, created_by) VALUES (?, 'PLACED', 'Order placed via API Layer', ?)");
            $stmtHist->execute([$orderId, $user['id']]);

            $stmtItem = $db->prepare("
                INSERT INTO order_items (order_id, product_variant_id, quantity, price, wholesale_price)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmtItem->execute([$orderId, $variantId, $qty, $variant['price'], $variant['wholesale_price']]);

            $stmtStock = $db->prepare("UPDATE product_variants SET stock = stock - ? WHERE id = ?");
            $stmtStock->execute([$qty, $variantId]);

            $stmtInvLog = $db->prepare("
                INSERT INTO inventory_logs (product_variant_id, type, quantity, reason)
                VALUES (?, 'OUT', ?, ?)
            ");
            $stmtInvLog->execute([$variantId, $qty, "Sold via REST API order #{$orderNumber}"]);

            $db->commit();
            return $response->json(['success' => true, 'order_number' => $orderNumber, 'total' => $total]);

        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'API Checkout crashed: ' . $e->getMessage()], 500);
        }
    }

    // 9. GET /api/wallet/balance (Fetch User Wallet Balance)
    public function getWalletBalance(Request $request, Response $response) {
        $user = $this->authenticateApi($request, $response);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT balance FROM wallets WHERE user_id = ?");
        $stmt->execute([$user['id']]);
        $balance = $stmt->fetchColumn() ?: 0.00;

        return $response->json(['balance' => floatval($balance)]);
    }

    // 10. POST /api/payments/charge (Simulated Refill Wallet / UPI Payments API)
    public function chargePayment(Request $request, Response $response) {
        $user = $this->authenticateApi($request, $response, ['RETAILER']);
        if (!$user) return;

        $body = $request->getBody();
        $amount = floatval($body['amount'] ?? 0);
        $method = trim($body['payment_method'] ?? 'UPI'); // UPI, CARD, NETBANKING

        if ($amount <= 0) {
            return $response->json(['error' => 'Invalid refill payment amount.'], 400);
        }

        $db = Application::$app->db;

        try {
            $db->beginTransaction();

            // 1. Credit retailer profile balance
            $stmtUpRet = $db->prepare("UPDATE retailer_profiles SET balance = balance + ? WHERE user_id = ?");
            $stmtUpRet->execute([$amount, $user['id']]);

            // 2. Credit wallets table
            $stmtUpWallet = $db->prepare("UPDATE wallets SET balance = balance + ? WHERE user_id = ?");
            $stmtUpWallet->execute([$amount, $user['id']]);

            $stmtWallet = $db->prepare("SELECT id, balance FROM wallets WHERE user_id = ?");
            $stmtWallet->execute([$user['id']]);
            $wallet = $stmtWallet->fetch();

            // 3. Log credit transaction ledger
            $stmtTx = $db->prepare("
                INSERT INTO wallet_transactions (wallet_id, type, amount, description, reference_type, balance_after)
                VALUES (?, 'CREDIT', ?, ?, 'DEPOSIT_CREDIT', ?)
            ");
            $stmtTx->execute([
                $wallet['id'], 
                $amount, 
                "Refilled wallet via payment gateway transaction ({$method})", 
                $wallet['balance']
            ]);

            $db->commit();
            return $response->json(['success' => true, 'new_balance' => floatval($wallet['balance'])]);

        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'Payment gateway simulation crashed: ' . $e->getMessage()], 500);
        }
    }

    // 11. POST /api/kyc/upload (Merchant KYC Document submission API)
    public function uploadKyc(Request $request, Response $response) {
        $user = $this->authenticateApi($request, $response, ['SELLER', 'RETAILER', 'DELIVERY']);
        if (!$user) return;

        $body = $request->getBody();
        $docType = trim($body['document_type'] ?? ''); // GST, AADHAAR, PAN, MSME, SHOP_LICENSE
        $docNumber = trim($body['document_number'] ?? '');
        $mockFileBase64 = trim($body['file_data'] ?? ''); // Simulated base64 document upload

        if (empty($docType) || empty($docNumber)) {
            return $response->json(['error' => 'Document Type and Document Certificate Number are required.'], 400);
        }

        $db = Application::$app->db;
        $mockPath = '/uploads/kyc/' . strtolower($docType) . '_' . time() . '.pdf';

        try {
            $stmt = $db->prepare("
                INSERT INTO kyc_documents (user_id, document_type, document_number, file_path, status)
                VALUES (?, ?, ?, ?, 'PENDING')
            ");
            $stmt->execute([$user['id'], $docType, $docNumber, $mockPath]);
            
            return $response->json(['success' => true, 'document_path' => $mockPath, 'status' => 'PENDING']);
        } catch (\Throwable $e) {
            return $response->json(['error' => 'KYC upload failed: ' . $e->getMessage()], 500);
        }
    }

    // 12. GET /api/notifications (Fetch User Alerts & Notification logs)
    public function getNotifications(Request $request, Response $response) {
        $user = $this->authenticateApi($request, $response);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->prepare("
            SELECT id, title, message, is_read, created_at 
            FROM notifications 
            WHERE user_id = ? 
            ORDER BY id DESC LIMIT 50
        ");
        $stmt->execute([$user['id']]);
        $notifs = $stmt->fetchAll() ?: [];
        return $response->json($notifs);
    }

    // 13. GET /api/reports/sales (Sales Reports / Revenue summary API)
    public function getSalesReport(Request $request, Response $response) {
        $user = $this->authenticateApi($request, $response, ['SUPER_ADMIN', 'ADMIN', 'SELLER']);
        if (!$user) return;

        $db = Application::$app->db;

        try {
            if (in_array($user['role'], ['SUPER_ADMIN', 'ADMIN'])) {
                $totalSales = $db->query("SELECT SUM(net_amount) FROM orders WHERE payment_status = 'PAID'")->fetchColumn() ?: 0.00;
                $totalCommissions = $db->query("SELECT SUM(commission_deducted) FROM seller_settlements WHERE status = 'SUCCESS'")->fetchColumn() ?: 0.00;
                $totalOrders = $db->query("SELECT COUNT(*) FROM orders")->fetchColumn() ?: 0;
                
                return $response->json([
                    'scope' => 'PLATFORM_WIDE',
                    'revenue' => floatval($totalSales),
                    'commission_earned' => floatval($totalCommissions),
                    'orders_count' => intval($totalOrders)
                ]);
            } else {
                $stmtSales = $db->prepare("SELECT SUM(total_amount) FROM orders WHERE seller_id = ? AND payment_status = 'PAID'");
                $stmtSales->execute([$user['id']]);
                $sales = $stmtSales->fetchColumn() ?: 0.00;

                $stmtOrders = $db->prepare("SELECT COUNT(*) FROM orders WHERE seller_id = ?");
                $stmtOrders->execute([$user['id']]);
                $orders = $stmtOrders->fetchColumn() ?: 0;

                $stmtPayouts = $db->prepare("SELECT SUM(net_payout) FROM seller_settlements WHERE seller_id = ? AND status = 'SUCCESS'");
                $stmtPayouts->execute([$user['id']]);
                $payouts = $stmtPayouts->fetchColumn() ?: 0.00;

                return $response->json([
                    'scope' => 'SELLER_HUB',
                    'gross_sales' => floatval($sales),
                    'disbursed_earnings' => floatval($payouts),
                    'orders_count' => intval($orders)
                ]);
            }
        } catch (\Throwable $e) {
            return $response->json(['error' => 'Analytics calculation failed: ' . $e->getMessage()], 500);
        }
    }

    // 14. POST /api/delivery/update (Logistics dispatch & Otp completion verification)
    public function updateDelivery(Request $request, Response $response) {
        $user = $this->authenticateApi($request, $response, ['DELIVERY']);
        if (!$user) return;

        $body = $request->getBody();
        $assignId = intval($body['assignment_id'] ?? 0);
        $newStatus = trim($body['status'] ?? '');

        if ($assignId <= 0 || !in_array($newStatus, ['PICKED_UP', 'OUT_FOR_DELIVERY', 'DELIVERED'])) {
            return $response->json(['error' => 'Invalid parameters'], 400);
        }

        $db = Application::$app->db;

        $stmt = $db->prepare("SELECT id, status, shipment_id FROM delivery_assignments WHERE id = ? AND delivery_partner_id = ?");
        $stmt->execute([$assignId, $user['id']]);
        $assign = $stmt->fetch();

        if (!$assign) {
            return $response->json(['error' => 'Logistics assignment not found.'], 404);
        }

        if ($newStatus === 'DELIVERED') {
            $otp = trim($body['otp'] ?? '');
            if (empty($otp)) {
                return $response->json(['error' => 'Handover OTP is required to mark as delivered.'], 400);
            }
            $stmtProof = $db->prepare("SELECT otp_code FROM delivery_proofs WHERE delivery_assignment_id = ?");
            $stmtProof->execute([$assignId]);
            $proofOtp = $stmtProof->fetchColumn();

            if ($proofOtp !== $otp) {
                return $response->json(['error' => 'Incorrect handover OTP.'], 400);
            }
        }

        try {
            $db->beginTransaction();
            $now = date('Y-m-d H:i:s');

            if ($newStatus === 'DELIVERED') {
                $stmtUp = $db->prepare("UPDATE delivery_assignments SET status = 'DELIVERED', completed_at = ? WHERE id = ?");
                $stmtUp->execute([$now, $assignId]);

                $stmtProofUp = $db->prepare("UPDATE delivery_proofs SET verified_at = ? WHERE delivery_assignment_id = ?");
                $stmtProofUp->execute([$now, $assignId]);

                $stmtShip = $db->prepare("SELECT order_id FROM shipments WHERE id = ?");
                $stmtShip->execute([$assign['shipment_id']]);
                $orderId = $stmtShip->fetchColumn();

                if ($orderId) {
                    $stmtUpOrder = $db->prepare("UPDATE orders SET status = 'DELIVERED' WHERE id = ?");
                    $stmtUpOrder->execute([$orderId]);

                    $stmtHistory = $db->prepare("INSERT INTO order_status_history (order_id, status, comments, created_by) VALUES (?, 'DELIVERED', 'Delivered via API OTP Verification', ?)");
                    $stmtHistory->execute([$orderId, $user['id']]);
                }

                $payout = 150.00;
                $stmtDriver = $db->prepare("UPDATE delivery_partner_profiles SET balance = balance + ? WHERE user_id = ?");
                $stmtDriver->execute([$payout, $user['id']]);

                $stmtDriverWallet = $db->prepare("UPDATE wallets SET balance = balance + ? WHERE user_id = ?");
                $stmtDriverWallet->execute([$payout, $user['id']]);
            } else {
                $stmtUp = $db->prepare("UPDATE delivery_assignments SET status = ? WHERE id = ?");
                $stmtUp->execute([$newStatus, $assignId]);

                $mappedOrderStatus = $newStatus === 'PICKED_UP' ? 'SHIPPED' : 'OUT_FOR_DELIVERY';

                $stmtShip = $db->prepare("SELECT order_id FROM shipments WHERE id = ?");
                $stmtShip->execute([$assign['shipment_id']]);
                $orderId = $stmtShip->fetchColumn();

                if ($orderId) {
                    $stmtUpOrder = $db->prepare("UPDATE orders SET status = ? WHERE id = ?");
                    $stmtUpOrder->execute([$mappedOrderStatus, $orderId]);
                }
            }

            $db->commit();
            return $response->json(['success' => true]);

        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'API Transit update crashed: ' . $e->getMessage()], 500);
        }
    }

    // --- MOCK SIMULATORS FOR UI TRIGGERS ---
    public function depositSimulate(Request $request, Response $response) {
        $user = Application::$app->getSessionUser();
        if (!$user) {
            return $response->json(['error' => 'Unauthorised'], 401);
        }

        $body = $request->getBody();
        $amount = floatval($body['amount'] ?? 0);

        if ($amount <= 0) {
            return $response->json(['error' => 'Invalid amount'], 400);
        }

        $db = Application::$app->db;

        try {
            $db->beginTransaction();

            $stmtUpRet = $db->prepare("UPDATE retailer_profiles SET balance = balance + ? WHERE user_id = ?");
            $stmtUpRet->execute([$amount, $user['id']]);

            $stmtUpWallet = $db->prepare("UPDATE wallets SET balance = balance + ? WHERE user_id = ?");
            $stmtUpWallet->execute([$amount, $user['id']]);

            $stmtWalletId = $db->prepare("SELECT id FROM wallets WHERE user_id = ?");
            $stmtWalletId->execute([$user['id']]);
            $walletId = $stmtWalletId->fetchColumn();

            $stmtTx = $db->prepare("
                INSERT INTO wallet_transactions (wallet_id, type, amount, description, reference_type, balance_after)
                VALUES (?, 'CREDIT', ?, 'Simulated demo deposit credit', 'DEPOSIT_CREDIT', (SELECT balance FROM wallets WHERE id = ?))
            ");
            $stmtTx->execute([$walletId, $amount, $user['id']]);

            $db->commit();
            return $response->json(['success' => true]);

        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'Simulated deposit failed: ' . $e->getMessage()], 500);
        }
    }

    public function kycSimulate(Request $request, Response $response) {
        $user = Application::$app->getSessionUser();
        if (!$user) {
            return $response->json(['error' => 'Unauthorised'], 401);
        }

        $db = Application::$app->db;

        try {
            $db->beginTransaction();

            $stmt = $db->prepare("
                INSERT INTO kyc_documents (user_id, document_type, document_number, file_path, status)
                VALUES (?, 'GST', '09AAAAA1111A1Z1', '/uploads/kyc/gst_mock.pdf', 'PENDING')
            ");
            $stmt->execute([$user['id']]);

            $db->commit();
            return $response->json(['success' => true]);

        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'Simulate failed: ' . $e->getMessage()], 500);
        }
    }

    public function getProductVariant(Request $request, Response $response) {
        $db = Application::$app->db;
        $params = $request->getRouteParams();
        $id = intval($params['id'] ?? 0);
        if ($id <= 0) {
            return $response->json(['error' => 'Invalid variant id'], 400);
        }
        $stmt = $db->prepare("
            SELECT pv.id, pv.product_id, pv.wholesale_price, pv.price, pv.image_url, pv.color, pv.stock,
                   p.title, p.description, c.name as category_name
            FROM product_variants pv
            JOIN products p ON pv.product_id = p.id
            JOIN categories c ON p.category_id = c.id
            WHERE pv.id = ? AND p.status = 'ACTIVE' AND p.is_approved = 1
            LIMIT 1
        ");
        $stmt->execute([$id]);
        $variant = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$variant) {
            return $response->json(['error' => 'Not found'], 404);
        }
        header('Content-Type: application/json');
        echo json_encode($variant);
        exit;
    }
}

