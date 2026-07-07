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

    public function dashboard(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $db = Application::$app->db;

        $totalSellers = $db->query("SELECT COUNT(*) FROM users WHERE role_id = 3")->fetchColumn() ?: 0;
        $totalRetailers = $db->query("SELECT COUNT(*) FROM users WHERE role_id = 4")->fetchColumn() ?: 0;
        $totalProducts = $db->query("SELECT COUNT(*) FROM products")->fetchColumn() ?: 0;
        $pendingProducts = $db->query("SELECT COUNT(*) FROM products WHERE is_approved = 0")->fetchColumn() ?: 0;
        $totalOrders = $db->query("SELECT COUNT(*) FROM orders")->fetchColumn() ?: 0;
        $totalSales = $db->query("SELECT SUM(net_amount) FROM orders WHERE payment_status = 'PAID'")->fetchColumn() ?: 0.00;
        
        $totalErrors = $db->query("SELECT COUNT(*) FROM error_logs")->fetchColumn() ?: 0;
        
        $totalCommission = $db->query("SELECT SUM(commission_deducted) FROM seller_settlements WHERE status = 'SUCCESS'")->fetchColumn() ?: 0.00;

        return $this->render('admin/dashboard', [
            'title' => 'Super Admin Console - Pavitra Designer',
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

    public function kyc(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $db = Application::$app->db;
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

            $stmt = $db->prepare("UPDATE kyc_documents SET status = ? WHERE id = ?");
            $stmt->execute([$status, $kycDocId]);

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

    public function settlements(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $db = Application::$app->db;
        
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

            $settleNum = 'SET-' . strtoupper(bin2hex(random_bytes(4))) . '-' . time();
            $stmtMaster = $db->prepare("INSERT INTO settlements (settlement_number, status, total_amount) VALUES (?, 'SETTLED', 0)");
            $stmtMaster->execute([$settleNum]);
            $masterSettleId = $db->lastInsertId();

            $totalSettleAmount = 0.00;

            foreach ($orderIds as $orderId) {
                $orderId = intval($orderId);
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
                $commRate = floatval($order['commission_rate']);
                $commission = ($salesAmount * $commRate) / 100.00;
                $tax = ($salesAmount * 5.00) / 100.00;
                $netPayout = $salesAmount - $commission - $tax;

                $stmtSellerSettle = $db->prepare("
                    INSERT INTO seller_settlements (settlement_id, seller_id, order_id, sales_amount, commission_deducted, tax_deducted, net_payout, status)
                    VALUES (?, ?, ?, ?, ?, ?, ?, 'SUCCESS')
                ");
                $stmtSellerSettle->execute([$masterSettleId, $order['seller_id'], $orderId, $salesAmount, $commission, $tax, $netPayout]);

                $stmtUpProfile = $db->prepare("UPDATE seller_profiles SET balance = balance + ? WHERE user_id = ?");
                $stmtUpProfile->execute([$netPayout, $order['seller_id']]);

                $stmtUpWallet = $db->prepare("UPDATE wallets SET balance = balance + ? WHERE user_id = ?");
                $stmtUpWallet->execute([$netPayout, $order['seller_id']]);

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

            $stmtUpMaster = $db->prepare("UPDATE settlements SET total_amount = ? WHERE id = ?");
            $stmtUpMaster->execute([$totalSettleAmount, $masterSettleId]);

            $db->commit();
            return $response->json(['success' => true]);

        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'Failed to process settlements: ' . $e->getMessage()], 500);
        }
    }

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

        if ($sellerId) {
            $stmtUp = $db->prepare("UPDATE seller_profiles SET commission_rate = ? WHERE user_id = ?");
            $stmtUp->execute([$rate, $sellerId]);
        }

        return $response->json(['success' => true]);
    }

    public function settings(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN']);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->query("SELECT setting_key, setting_value FROM system_settings");
        $settings = $stmt->fetchAll(\PDO::FETCH_KEY_PAIR) ?: [];

        return $this->render('admin/settings', [
            'title' => 'System Settings Configuration - Pavitra Designer',
            'settings' => $settings
        ]);
    }

    public function saveSettings(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN']);
        if (!$user) return;

        $body = $request->getBody();
        $db = Application::$app->db;

        try {
            $db->beginTransaction();

            $allowedKeys = [
                'company_name', 'brand_name', 'logo_url', 'favicon_url', 'gst_number', 'cin_number', 'pan_number',
                'support_email', 'support_mobile', 'whatsapp_number', 'registered_office_address', 'corporate_office_address',
                'social_facebook', 'social_instagram', 'social_youtube', 'social_linkedin',
                'smtp_host', 'smtp_port', 'smtp_user', 'smtp_password',
                'sms_gateway_key', 'sms_gateway_secret',
                'whatsapp_api_key', 'whatsapp_api_secret',
                'payment_gateway_key', 'payment_gateway_secret',
                'cloudflare_account_id', 'cloudflare_api_token', 'google_maps_api_key',
                'cdn_prefix', 'twilio_sid', 'twilio_auth_token', 'twilio_phone_number',
                'sendgrid_api_key', 'sendgrid_from_email'
            ];

            $stmt = $db->prepare("INSERT INTO system_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");

            foreach ($allowedKeys as $key) {
                if (isset($body[$key])) {
                    $stmt->execute([$key, trim($body[$key])]);
                }
            }

            $db->commit();
            Application::$app->loadConfig();

            $_SESSION['settings_success'] = 'System settings updated successfully!';
            $response->redirect('/admin/settings');
            return;
        } catch (\Throwable $e) {
            $db->rollBack();
            return $this->render('admin/settings', [
                'title' => 'System Settings Configuration - Pavitra Designer',
                'settings' => $body,
                'error' => 'Settings save failed: ' . $e->getMessage()
            ]);
        }
    }

    public function sessions(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $db = Application::$app->db;
        $sessions = $db->query("
            SELECT us.*, u.name as user_name, u.email, r.name as role_name
            FROM user_sessions us
            JOIN users u ON us.user_id = u.id
            JOIN roles r ON u.role_id = r.id
            ORDER BY us.last_active DESC, us.id DESC
        ")->fetchAll() ?: [];

        return $this->render('admin/sessions', [
            'title' => 'Device Management & Session Control',
            'sessions' => $sessions
        ]);
    }

    public function revokeSession(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $body = $request->getBody();
        $token = trim($body['token'] ?? '');

        if ($token === '') {
            return $response->json(['error' => 'Invalid session token'], 400);
        }

        $db = Application::$app->db;
        $stmt = $db->prepare("DELETE FROM user_sessions WHERE token = ?");
        $stmt->execute([$token]);

        return $response->json(['success' => true]);
    }

    public function activityLogs(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;

        $db = Application::$app->db;
        $logs = $db->query("
            SELECT al.*, u.name as user_name, u.email
            FROM activity_logs al
            LEFT JOIN users u ON al.user_id = u.id
            ORDER BY al.created_at DESC, al.id DESC
            LIMIT 200
        ")->fetchAll() ?: [];

        return $this->render('admin/activity', [
            'title' => 'Login Logs & Activity Audit Trail',
            'logs' => $logs
        ]);
    }

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

    public function cms(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN']);
        if (!$user) return;

        $db = Application::$app->db;
        $pages = $db->query("SELECT * FROM cms_pages ORDER BY title ASC")->fetchAll() ?: [];

        return $this->render('admin/cms_list', [
            'title' => 'Page Manager - Pavitra Designer',
            'pages' => $pages
        ]);
    }

    public function cmsEdit(Request $request, Response $response, array $params) {
        $user = $this->checkAuth(['SUPER_ADMIN']);
        if (!$user) return;

        $id = intval($params['id'] ?? 0);
        $db = Application::$app->db;

        $stmt = $db->prepare("SELECT * FROM cms_pages WHERE id = ?");
        $stmt->execute([$id]);
        $page = $stmt->fetch();

        if (!$page) {
            $response->redirect('/admin/cms');
            return;
        }

        return $this->render('admin/cms_edit', [
            'title' => 'Edit ' . $page['title'] . ' - Pavitra Designer',
            'page' => $page
        ]);
    }

    public function cmsSave(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN']);
        if (!$user) return;

        $body = $request->getBody();
        $id = intval($body['id'] ?? 0);
        $title = trim($body['title'] ?? '');
        $slug = trim($body['slug'] ?? '');
        $metaTitle = trim($body['meta_title'] ?? '');
        $metaDescription = trim($body['meta_description'] ?? '');
        $active = isset($body['active']) ? intval($body['active']) : 1;
        $content = $body['content'] ?? ''; // This is the JSON string of blocks

        $errors = [];
        if (empty($title)) $errors[] = 'Title is required.';
        if (empty($slug)) $errors[] = 'Slug is required.';
        if (empty($content)) $errors[] = 'Content is required.';

        $db = Application::$app->db;

        if (empty($errors)) {
            $stmt = $db->prepare("UPDATE cms_pages SET title = ?, slug = ?, content = ?, meta_title = ?, meta_description = ?, active = ? WHERE id = ?");
            $stmt->execute([$title, $slug, $content, $metaTitle, $metaDescription, $active, $id]);

            $_SESSION['settings_success'] = 'CMS Page updated successfully!';
            return $response->json(['success' => true]);
        }

        return $response->json(['error' => implode(' ', $errors)], 400);
    }
}

