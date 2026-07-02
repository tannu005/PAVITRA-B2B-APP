<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Application;

class InvoiceController extends Controller {

    public function __construct() {
        // No layout, this is a print-only raw view
        $this->setLayout(null);
    }

    // View print-optimized tax invoice sheet
    public function printInvoice(Request $request, Response $response, array $params) {
        // Auth check: allow retailer (buyer), seller (weaver), or admin
        $user = Application::$app->getSessionUser();
        if (!$user) {
            $response->redirect('/login');
            return;
        }

        $orderId = intval($params['id'] ?? 0);
        $db = Application::$app->db;

        // Fetch order details
        $stmt = $db->prepare("
            SELECT o.*, u.name as buyer_name, u.email as buyer_email, u.mobile as buyer_mobile,
                   s.name as seller_name, sp.company_name as seller_company, sp.gst_number as seller_gst,
                   ua.address_line1, ua.city, ua.state, ua.pin_code
            FROM orders o
            JOIN users u ON o.user_id = u.id
            JOIN users s ON o.seller_id = s.id
            JOIN seller_profiles sp ON o.seller_id = sp.user_id
            LEFT JOIN user_addresses ua ON o.address_id = ua.id
            WHERE o.id = ?
        ");
        $stmt->execute([$orderId]);
        $order = $stmt->fetch();

        if (!$order) {
            $response->setStatusCode(404);
            echo "<h1>Invoice Not Found</h1>";
            return;
        }

        // Verify authorization: buyer, seller, or admin
        if (!in_array($user['role'], ['SUPER_ADMIN', 'ADMIN']) && $order['user_id'] != $user['id'] && $order['seller_id'] != $user['id']) {
            $response->setStatusCode(403);
            echo "<h1>Access Denied</h1>";
            return;
        }

        // Fetch order items
        $stmtItems = $db->prepare("
            SELECT oi.*, pv.sku, pv.bulk_threshold, p.title, p.description
            FROM order_items oi
            JOIN product_variants pv ON oi.product_variant_id = pv.id
            JOIN products p ON pv.product_id = p.id
            WHERE oi.order_id = ?
        ");
        $stmtItems->execute([$orderId]);
        $items = $stmtItems->fetchAll() ?: [];

        // Load company settings
        $companyName = Application::$app->config['company_name'] ?? 'Pavitra B2B';
        $companyGst = Application::$app->config['gst_number'] ?? '09AAAAA1111A1Z1';
        $companyAddress = Application::$app->config['office_address'] ?? 'Varanasi, UP';

        return $this->render('retailer/invoice', [
            'order' => $order,
            'items' => $items,
            'companyName' => $companyName,
            'companyGst' => $companyGst,
            'companyAddress' => $companyAddress
        ]);
    }
}

