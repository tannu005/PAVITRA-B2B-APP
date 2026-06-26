<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Application;

class SuperAdminController extends Controller {

    public function __construct() {
        $this->setLayout('main');
    }

    // Admin Dashboard stats
    public function dashboard(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $db = Application::$app->db;

        // Fetch counts
        $totalSellers = $db->query("SELECT COUNT(*) FROM users WHERE role_id = 3")->fetchColumn() ?: 0;
        $totalRetailers = $db->query("SELECT COUNT(*) FROM users WHERE role_id = 4")->fetchColumn() ?: 0;
        $totalProducts = $db->query("SELECT COUNT(*) FROM products")->fetchColumn() ?: 0;
        $pendingProducts = $db->query("SELECT COUNT(*) FROM products WHERE is_approved = 0")->fetchColumn() ?: 0;
        $totalOrders = $db->query("SELECT COUNT(*) FROM orders")->fetchColumn() ?: 0;
        $totalSales = $db->query("SELECT SUM(net_amount) FROM orders WHERE payment_status = 'PAID'")->fetchColumn() ?: 0.00;
        
        // Count errors
        $totalErrors = $db->query("SELECT COUNT(*) FROM error_logs")->fetchColumn() ?: 0;
        
        // Sum commission earned
        $totalCommission = $db->query("SELECT SUM(commission_deducted) FROM seller_settlements WHERE status = 'SUCCESS'")->fetchColumn() ?: 0.00;

        return $this->render('admin/dashboard', [
            'title' => 'Super Admin Console - Viraasat B2B',
            'stats' => [
                'sellers' => $totalSellers,
                'retailers' => $totalRetailers,
                'products' => $totalProducts,
                'pending_products' => $pendingProducts,
                'orders' => $totalOrders,
                'sales' => $totalSales,
                'commission' => $totalCommission,
                'errors' => $totalErrors
            ]
        ]);
    }

    // Sellers approval lists
    public function sellers(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->query("
            SELECT u.id, u.name, u.email, u.mobile, u.status, r.name as role, COALESCE(sp.company_name, rp.shop_name) as trade_name
            FROM users u
            JOIN roles r ON u.role_id = r.id
            LEFT JOIN seller_profiles sp ON u.id = sp.user_id
            LEFT JOIN retailer_profiles rp ON u.id = rp.user_id
            WHERE r.name IN ('SELLER', 'RETAILER')
            ORDER BY u.id DESC
        ");
        $usersList = $stmt->fetchAll() ?: [];

        return $this->render('admin/sellers', [
            'title' => 'User Directory & Approvals',
            'usersList' => $usersList
        ]);
    }

    // Approve seller
    public function approveSeller(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $body = $request->getBody();
        $targetUserId = intval($body['user_id'] ?? 0);
        $actionStatus = trim($body['status'] ?? 'ACTIVE');

        if ($targetUserId <= 0 || !in_array($actionStatus, ['ACTIVE', 'BLOCKED'])) {
            return $response->json(['error' => 'Invalid parameters'], 400);
        }

        $db = Application::$app->db;
        $stmt = $db->prepare("UPDATE users SET status = ? WHERE id = ?");
        $stmt->execute([$actionStatus, $targetUserId]);

        return $response->json(['success' => true]);
    }

    // Products approval lists
    public function products(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->query("
            SELECT p.*, pv.sku, pv.wholesale_price, pv.stock, u.name as seller_name, c.name as category_name
            FROM products p
            JOIN product_variants pv ON pv.product_id = p.id
            JOIN users u ON p.seller_id = u.id
            JOIN categories c ON p.category_id = c.id
            ORDER BY p.id DESC
        ");
        $productsList = $stmt->fetchAll() ?: [];

        return $this->render('admin/products', [
            'title' => 'Saree Catalog Validation Gateway',
            'productsList' => $productsList
        ]);
    }

    // Toggle product approval
    public function approveProduct(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $body = $request->getBody();
        $prodId = intval($body['product_id'] ?? 0);
        $approve = intval($body['approve'] ?? 0);

        if ($prodId <= 0) {
            return $response->json(['error' => 'Invalid parameters'], 400);
        }

        $db = Application::$app->db;
        $stmt = $db->prepare("UPDATE products SET is_approved = ? WHERE id = ?");
        $stmt->execute([$approve, $prodId]);

        return $response->json(['success' => true]);
    }

    // KYC Verification Deck
    public function kyc(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $db = Application::$app->db;
        // Fetch all KYC documents or select seeded kyc documents
        // Since we don't have many seeded document records, let's select from kyc_documents table
        $stmt = $db->query("
            SELECT kd.*, u.name as user_name, u.email as user_email
            FROM kyc_documents kd
            JOIN users u ON kd.user_id = u.id
            ORDER BY kd.id DESC
        ");
        $kycList = $stmt->fetchAll() ?: [];

        return $this->render('admin/kyc', [
            'title' => 'KYC Compliance Verification Deck',
            'kycList' => $kycList
        ]);
    }

    // Verify KYC
    public function verifyKyc(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $body = $request->getBody();
        $kycDocId = intval($body['kyc_id'] ?? 0);
        $status = trim($body['status'] ?? 'VERIFIED'); // VERIFIED or REJECTED

        if ($kycDocId <= 0 || !in_array($status, ['VERIFIED', 'REJECTED'])) {
            return $response->json(['error' => 'Invalid parameters'], 400);
        }

        $db = Application::$app->db;
        
        try {
            $db->beginTransaction();

            // Update kyc document
            $stmt = $db->prepare("UPDATE kyc_documents SET status = ? WHERE id = ?");
            $stmt->execute([$status, $kycDocId]);

            // Add kyc verification record
            $stmtVer = $db->prepare("
                INSERT INTO kyc_verifications (kyc_document_id, verified_by, status, comments)
                VALUES (?, ?, ?, 'Verified by system admin console')
            ");
            $stmtVer->execute([$kycDocId, $user['id'], $status]);

            $db->commit();
            return $response->json(['success' => true]);
        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'KYC status update failed: ' . $e->getMessage()], 500);
        }
    }

    // Settlements lists and payout trigger room
    public function settlements(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $db = Application::$app->db;
        
        // Fetch delivered orders that haven't been settled yet
        $stmt = $db->query("
            SELECT o.*, u.name as buyer_name, s.name as seller_name, sp.commission_rate
            FROM orders o
            JOIN users u ON o.user_id = u.id
            JOIN users s ON o.seller_id = s.id
            JOIN seller_profiles sp ON o.seller_id = sp.user_id
            LEFT JOIN seller_settlements ss ON ss.order_id = o.id
            WHERE o.status = 'DELIVERED' AND ss.id IS NULL
            ORDER BY o.id DESC
        ");
        $unsettledOrders = $stmt->fetchAll() ?: [];

        // Fetch processed settlements
        $stmtProcessed = $db->query("
            SELECT ss.*, o.order_number, s.name as seller_name, setl.settlement_number
            FROM seller_settlements ss
            JOIN orders o ON ss.order_id = o.id
            JOIN users s ON ss.seller_id = s.id
            JOIN settlements setl ON ss.settlement_id = setl.id
            ORDER BY ss.id DESC
        ");
        $settledList = $stmtProcessed->fetchAll() ?: [];

        return $this->render('admin/settlements', [
            'title' => 'Seller Settlements & Disbursements Room',
            'unsettledOrders' => $unsettledOrders,
            'settledList' => $settledList
        ]);
    }

    // Trigger process settlements
    public function processSettlements(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $body = $request->getBody();
        $orderIds = $body['order_ids'] ?? [];

        if (empty($orderIds)) {
            return $response->json(['error' => 'Please select at least one order to settle.'], 400);
        }

        $db = Application::$app->db;

        try {
            $db->beginTransaction();

            // Create Master Settlement Payout ID
            $settleNum = 'SET-' . strtoupper(bin2hex(random_bytes(4))) . '-' . time();
            $stmtMaster = $db->prepare("INSERT INTO settlements (settlement_number, status, total_amount) VALUES (?, 'SETTLED', 0)");
            $stmtMaster->execute([$settleNum]);
            $masterSettleId = $db->lastInsertId();

            $totalSettleAmount = 0.00;

            foreach ($orderIds as $orderId) {
                $orderId = intval($orderId);
                // Fetch order and seller rate
                $stmt = $db->prepare("
                    SELECT o.*, sp.commission_rate
                    FROM orders o
                    JOIN seller_profiles sp ON o.seller_id = sp.user_id
                    LEFT JOIN seller_settlements ss ON ss.order_id = o.id
                    WHERE o.id = ? AND o.status = 'DELIVERED' AND ss.id IS NULL
                ");
                $stmt->execute([$orderId]);
                $order = $stmt->fetch();

                if (!$order) {
                    continue; // Skip invalid or already settled
                }

                $salesAmount = floatval($order['total_amount']);
                // Deduct commission rate
                $commRate = floatval($order['commission_rate']);
                $commission = ($salesAmount * $commRate) / 100.00;
                // Deduct GST rate (5% HSN code for saree fabrics)
                $tax = ($salesAmount * 5.00) / 100.00;
                $netPayout = $salesAmount - $commission - $tax;

                // Create seller settlement entry
                $stmtSellerSettle = $db->prepare("
                    INSERT INTO seller_settlements (settlement_id, seller_id, order_id, sales_amount, commission_deducted, tax_deducted, net_payout, status)
                    VALUES (?, ?, ?, ?, ?, ?, ?, 'SUCCESS')
                ");
                $stmtSellerSettle->execute([$masterSettleId, $order['seller_id'], $orderId, $salesAmount, $commission, $tax, $netPayout]);

                // Credit seller profile balance
                $stmtUpProfile = $db->prepare("UPDATE seller_profiles SET balance = balance + ? WHERE user_id = ?");
                $stmtUpProfile->execute([$netPayout, $order['seller_id']]);

                // Credit seller wallets balance table too
                $stmtUpWallet = $db->prepare("UPDATE wallets SET balance = balance + ? WHERE user_id = ?");
                $stmtUpWallet->execute([$netPayout, $order['seller_id']]);

                // Insert wallet transaction
                $stmtSellerWalletId = $db->prepare("SELECT id FROM wallets WHERE user_id = ?");
                $stmtSellerWalletId->execute([$order['seller_id']]);
                $sellerWalletId = $stmtSellerWalletId->fetchColumn();

                $stmtTx = $db->prepare("
                    INSERT INTO wallet_transactions (wallet_id, type, amount, description, reference_type, reference_id, balance_after)
                    VALUES (?, 'CREDIT', ?, ?, 'ORDER_SETTLEMENT', ?, (SELECT balance FROM wallets WHERE id = ?))
                ");
                $stmtTx->execute([$sellerWalletId, $netPayout, "Settlement payout for order #{$order['order_number']}", $orderId, $sellerWalletId]);

                $totalSettleAmount += $netPayout;
            }

            // Update master settlement total amount
            $stmtUpMaster = $db->prepare("UPDATE settlements SET total_amount = ? WHERE id = ?");
            $stmtUpMaster->execute([$totalSettleAmount, $masterSettleId]);

            $db->commit();
            return $response->json(['success' => true]);

        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'Failed to process settlements: ' . $e->getMessage()], 500);
        }
    }

    // Dynamic commissions manager
    public function commissions(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $db = Application::$app->db;
        $rules = $db->query("
            SELECT cr.*, c.name as category_name, u.name as seller_name
            FROM commission_rules cr
            LEFT JOIN categories c ON cr.category_id = c.id
            LEFT JOIN users u ON cr.seller_id = u.id
            ORDER BY cr.id DESC
        ")->fetchAll() ?: [];

        $categories = $db->query("SELECT id, name FROM categories")->fetchAll() ?: [];
        $sellers = $db->query("SELECT id, name FROM users WHERE role_id = 3")->fetchAll() ?: [];

        return $this->render('admin/commissions', [
            'title' => ' Dynamic Commissions Configurator',
            'rules' => $rules,
            'categories' => $categories,
            'sellers' => $sellers
        ]);
    }

    // Save commission rule
    public function saveCommissionRule(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $body = $request->getBody();
        $categoryId = !empty($body['category_id']) ? intval($body['category_id']) : null;
        $sellerId = !empty($body['seller_id']) ? intval($body['seller_id']) : null;
        $rate = floatval($body['rate'] ?? 5.00);

        if ($rate < 0 || $rate > 100) {
            return $response->json(['error' => 'Commission rate must be between 0% and 100%'], 400);
        }

        $db = Application::$app->db;
        $stmt = $db->prepare("INSERT INTO commission_rules (category_id, seller_id, rate) VALUES (?, ?, ?)");
        $stmt->execute([$categoryId, $sellerId, $rate]);

        // If it's a seller-specific rule, let's update their profile commission_rate directly too
        if ($sellerId) {
            $stmtUp = $db->prepare("UPDATE seller_profiles SET commission_rate = ? WHERE user_id = ?");
            $stmtUp->execute([$rate, $sellerId]);
        }

        return $response->json(['success' => true]);
    }

    // View error logs
    public function errors(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->query("SELECT * FROM error_logs ORDER BY id DESC LIMIT 50");
        $errorsList = $stmt->fetchAll() ?: [];

        return $this->render('admin/errors', [
            'title' => 'Application Trace logs & Exceptions',
            'errorsList' => $errorsList
        ]);
    }
}
