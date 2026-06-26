<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Application;

class ApiController extends Controller {

    // Helper: Authenticates API request using Authorization header
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

        // Look up token in user_sessions
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

    // 1. POST /api/auth/login
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

            // Generate token
            $token = bin2hex(random_bytes(32));
            
            // Insert session
            $ip = $_SERVER['REMOTE_ADDR'] ?? '';
            $agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
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

    // 2. GET /api/products
    public function getProducts(Request $request, Response $response) {
        $db = Application::$app->db;
        $stmt = $db->query("
            SELECT p.id, p.title, p.description, c.name as category_name, 
                   pv.sku, pv.color, pv.size, pv.price, pv.wholesale_price, pv.bulk_threshold, pv.stock, pv.image_url
            FROM products p
            JOIN product_variants pv ON pv.product_id = p.id
            JOIN categories c ON p.category_id = c.id
            WHERE p.status = 'ACTIVE' AND p.is_approved = 1
        ");
        $products = $stmt->fetchAll() ?: [];
        return $response->json($products);
    }

    // 3. GET /api/orders
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

    // 4. POST /api/orders/create
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

        // Verify variant and fetch seller
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

        // Calculate amount
        $isWholesale = ($qty >= intval($variant['bulk_threshold']));
        $price = $isWholesale ? floatval($variant['wholesale_price']) : floatval($variant['price']);
        $total = $price * $qty;

        // Check Retailer balance
        $stmtProfile = $db->prepare("SELECT balance FROM retailer_profiles WHERE user_id = ?");
        $stmtProfile->execute([$user['id']]);
        $balance = floatval($stmtProfile->fetchColumn() ?: 0);

        if ($balance < $total) {
            return $response->json(['error' => 'Insufficient wallet balance. Please refill credit balance.'], 400);
        }

        try {
            $db->beginTransaction();

            // Deduct balance
            $newBalance = $balance - $total;
            $stmtUpRet = $db->prepare("UPDATE retailer_profiles SET balance = ? WHERE user_id = ?");
            $stmtUpRet->execute([$newBalance, $user['id']]);

            // Deduct user wallet
            $stmtUpWallet = $db->prepare("UPDATE wallets SET balance = ? WHERE user_id = ?");
            $stmtUpWallet->execute([$newBalance, $user['id']]);

            $stmtRetWalletId = $db->prepare("SELECT id FROM wallets WHERE user_id = ?");
            $stmtRetWalletId->execute([$user['id']]);
            $retWalletId = $stmtRetWalletId->fetchColumn();

            // Insert transaction
            $stmtTx = $db->prepare("
                INSERT INTO wallet_transactions (wallet_id, type, amount, description, reference_type, balance_after)
                VALUES (?, 'DEBIT', ?, ?, 'ORDER_PURCHASE', ?)
            ");
            $stmtTx->execute([$retWalletId, $total, "API order purchase for variant SKU: #{$variant['sku']}", $newBalance]);

            // Address insertion
            $stmtAddr = $db->prepare("INSERT INTO user_addresses (user_id, address_line1, city, state, pin_code) VALUES (?, ?, 'Varanasi', 'UP', '221001')");
            $stmtAddr->execute([$user['id'], $address]);
            $addressId = $db->lastInsertId();

            // Create Order
            $orderNumber = 'ORD-' . strtoupper(bin2hex(random_bytes(4))) . '-' . time();
            $stmtOrder = $db->prepare("
                INSERT INTO orders (order_number, user_id, seller_id, status, total_amount, net_amount, payment_status, payment_method, address_id)
                VALUES (?, ?, ?, 'PLACED', ?, ?, 'PAID', 'WALLET', ?)
            ");
            $stmtOrder->execute([$orderNumber, $user['id'], $variant['seller_id'], $total, $total, $addressId]);
            $orderId = $db->lastInsertId();

            // History
            $stmtHist = $db->prepare("INSERT INTO order_status_history (order_id, status, comments, created_by) VALUES (?, 'PLACED', 'Order placed via API Layer', ?)");
            $stmtHist->execute([$orderId, $user['id']]);

            // Order items
            $stmtItem = $db->prepare("
                INSERT INTO order_items (order_id, product_variant_id, quantity, price, wholesale_price)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmtItem->execute([$orderId, $variantId, $qty, $variant['price'], $variant['wholesale_price']]);

            // Deduct stock
            $stmtStock = $db->prepare("UPDATE product_variants SET stock = stock - ? WHERE id = ?");
            $stmtStock->execute([$qty, $variantId]);

            // Log stock reduction
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

    // 5. GET /api/wallet/balance
    public function getWalletBalance(Request $request, Response $response) {
        $user = $this->authenticateApi($request, $response);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT balance FROM wallets WHERE user_id = ?");
        $stmt->execute([$user['id']]);
        $balance = $stmt->fetchColumn() ?: 0.00;

        return $response->json(['balance' => floatval($balance)]);
    }

    // 6. POST /api/delivery/update
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

        // Check ownership
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
            // Check OTP
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

                // Update order to DELIVERED
                $stmtShip = $db->prepare("SELECT order_id FROM shipments WHERE id = ?");
                $stmtShip->execute([$assign['shipment_id']]);
                $orderId = $stmtShip->fetchColumn();

                if ($orderId) {
                    $stmtUpOrder = $db->prepare("UPDATE orders SET status = 'DELIVERED' WHERE id = ?");
                    $stmtUpOrder->execute([$orderId]);

                    $stmtHistory = $db->prepare("INSERT INTO order_status_history (order_id, status, comments, created_by) VALUES (?, 'DELIVERED', 'Delivered via API OTP Verification', ?)");
                    $stmtHistory->execute([$orderId, $user['id']]);
                }

                // Credit delivery fee
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
    // POST /api/wallet/deposit
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

            // Credit retailer balance
            $stmtUpRet = $db->prepare("UPDATE retailer_profiles SET balance = balance + ? WHERE user_id = ?");
            $stmtUpRet->execute([$amount, $user['id']]);

            // Credit wallets table
            $stmtUpWallet = $db->prepare("UPDATE wallets SET balance = balance + ? WHERE user_id = ?");
            $stmtUpWallet->execute([$amount, $user['id']]);

            // Fetch wallet id
            $stmtWalletId = $db->prepare("SELECT id FROM wallets WHERE user_id = ?");
            $stmtWalletId->execute([$user['id']]);
            $walletId = $stmtWalletId->fetchColumn();

            // Log transaction
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

    // POST /api/kyc/simulate
    public function kycSimulate(Request $request, Response $response) {
        $user = Application::$app->getSessionUser();
        if (!$user) {
            return $response->json(['error' => 'Unauthorised'], 401);
        }

        $db = Application::$app->db;

        try {
            $db->beginTransaction();

            // Insert simulated Aadhaar KYC doc
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
}
