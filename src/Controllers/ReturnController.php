<?php
namespace App\Controllers;
use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Application;
class ReturnController extends Controller {
    public function __construct() {
        $this->setLayout('main');
    }
    public function createView(Request $request, Response $response, array $params) {
        $user = $this->checkAuth(['RETAILER']);
        if (!$user) return;
        $orderId = intval($params['id'] ?? 0);
        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ? AND status = 'DELIVERED'");
        $stmt->execute([$orderId, $user['id']]);
        $order = $stmt->fetch();
        if (!$order) {
            $response->redirect('/orders');
            return;
        }
        $stmtItems = $db->prepare("
            SELECT oi.*, pv.image_url, p.title
            FROM order_items oi
            JOIN product_variants pv ON oi.product_variant_id = pv.id
            JOIN products p ON pv.product_id = p.id
            WHERE oi.order_id = ?
        ");
        $stmtItems->execute([$orderId]);
        $items = $stmtItems->fetchAll() ?: [];
        return $this->render('retailer/returns/create', [
            'title' => 'Request Bulk Return - Pavitra Designer',
            'order' => $order,
            'items' => $items
        ]);
    }
    public function create(Request $request, Response $response, array $params) {
        $user = $this->checkAuth(['RETAILER']);
        if (!$user) return;
        $orderId = intval($params['id'] ?? 0);
        $body = $request->getBody();
        $reason = trim($body['reason'] ?? '');
        $returnQuantities = $body['quantities'] ?? []; 
        if (empty($reason)) {
            $_SESSION['return_error'] = 'Return reason is required.';
            $response->redirect("/orders/return/{$orderId}");
            return;
        }
        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ? AND status = 'DELIVERED'");
        $stmt->execute([$orderId, $user['id']]);
        $order = $stmt->fetch();
        if (!$order) {
            $response->redirect('/orders');
            return;
        }
        $hasItems = false;
        foreach ($returnQuantities as $itemId => $qty) {
            $qty = intval($qty);
            if ($qty > 0) {
                $hasItems = true;
                $stmtCheck = $db->prepare("SELECT quantity FROM order_items WHERE id = ? AND order_id = ?");
                $stmtCheck->execute([$itemId, $orderId]);
                $orderedQty = intval($stmtCheck->fetchColumn());
                if ($qty > $orderedQty) {
                    $_SESSION['return_error'] = 'Return quantity cannot exceed ordered quantity.';
                    $response->redirect("/orders/return/{$orderId}");
                    return;
                }
            }
        }
        if (!$hasItems) {
            $_SESSION['return_error'] = 'Please select at least one item and quantity to return.';
            $response->redirect("/orders/return/{$orderId}");
            return;
        }
        try {
            $db->beginTransaction();
            $returnNum = 'RET-' . strtoupper(bin2hex(random_bytes(4))) . '-' . time();
            $stmtInsert = $db->prepare("
                INSERT INTO returns (order_id, return_number, reason, status)
                VALUES (?, ?, ?, 'REQUESTED')
            ");
            $stmtInsert->execute([$orderId, $returnNum, $reason]);
            $returnId = $db->lastInsertId();
            foreach ($returnQuantities as $itemId => $qty) {
                $qty = intval($qty);
                if ($qty > 0) {
                    $stmtItem = $db->prepare("
                        INSERT INTO return_items (return_id, order_item_id, quantity, status)
                        VALUES (?, ?, ?, 'PENDING')
                    ");
                    $stmtItem->execute([$returnId, $itemId, $qty]);
                }
            }
            $stmtUpOrder = $db->prepare("UPDATE orders SET status = 'RETURNED' WHERE id = ?");
            $stmtUpOrder->execute([$orderId]);
            $stmtHist = $db->prepare("
                INSERT INTO order_status_history (order_id, status, comments, created_by)
                VALUES (?, 'RETURNED', ?, ?)
            ");
            $stmtHist->execute([$orderId, "Return requested (#{$returnNum})", $user['id']]);
            $db->commit();
            $_SESSION['order_success'] = "Return request #{$returnNum} submitted successfully!";
            $response->redirect('/orders');
            return;
        } catch (\Throwable $e) {
            $db->rollBack();
            $_SESSION['return_error'] = 'Failed to submit return request: ' . $e->getMessage();
            $response->redirect("/orders/return/{$orderId}");
        }
    }
    public function sellerIndex(Request $request, Response $response) {
        $user = $this->checkAuth(['SELLER']);
        if (!$user) return;
        $db = Application::$app->db;
        $stmt = $db->prepare("
            SELECT r.*, o.order_number, u.name as buyer_name
            FROM returns r
            JOIN orders o ON r.order_id = o.id
            JOIN users u ON o.user_id = u.id
            WHERE o.seller_id = ?
            ORDER BY r.id DESC
        ");
        $stmt->execute([$user['id']]);
        $returns = $stmt->fetchAll() ?: [];
        foreach ($returns as &$ret) {
            $stmtItems = $db->prepare("
                SELECT ri.quantity, p.title, pv.image_url, oi.price, oi.wholesale_price
                FROM return_items ri
                JOIN order_items oi ON ri.order_item_id = oi.id
                JOIN product_variants pv ON oi.product_variant_id = pv.id
                JOIN products p ON pv.product_id = p.id
                WHERE ri.return_id = ?
            ");
            $stmtItems->execute([$ret['id']]);
            $ret['items'] = $stmtItems->fetchAll() ?: [];
        }
        return $this->render('seller/returns/list', [
            'title' => 'Merchant Return requests - Weaver Hub',
            'returns' => $returns
        ]);
    }
    public function sellerApprove(Request $request, Response $response, array $params) {
        $user = $this->checkAuth(['SELLER']);
        if (!$user) return;
        $returnId = intval($params['id'] ?? 0);
        $db = Application::$app->db;
        $stmtCheck = $db->prepare("
            SELECT r.id FROM returns r
            JOIN orders o ON r.order_id = o.id
            WHERE r.id = ? AND o.seller_id = ? AND r.status = 'REQUESTED'
        ");
        $stmtCheck->execute([$returnId, $user['id']]);
        if (!$stmtCheck->fetch()) {
            $response->redirect('/seller/returns');
            return;
        }
        $stmtUp = $db->prepare("UPDATE returns SET status = 'APPROVED' WHERE id = ?");
        $stmtUp->execute([$returnId]);
        $response->redirect('/seller/returns');
    }
    public function sellerVerify(Request $request, Response $response, array $params) {
        $user = $this->checkAuth(['SELLER']);
        if (!$user) return;
        $returnId = intval($params['id'] ?? 0);
        $db = Application::$app->db;
        $stmtCheck = $db->prepare("
            SELECT r.*, o.user_id as buyer_id, o.order_number, o.commission_rate
            FROM returns r
            JOIN orders o ON r.order_id = o.id
            WHERE r.id = ? AND o.seller_id = ? AND r.status IN ('REQUESTED', 'APPROVED')
        ");
        $stmtCheck->execute([$returnId, $user['id']]);
        $return = $stmtCheck->fetch();
        if (!$return) {
            $response->redirect('/seller/returns');
            return;
        }
        $stmtItems = $db->prepare("
            SELECT ri.quantity, oi.price, oi.wholesale_price, oi.quantity as ordered_qty
            FROM return_items ri
            JOIN order_items oi ON ri.order_item_id = oi.id
            WHERE ri.return_id = ?
        ");
        $stmtItems->execute([$returnId]);
        $retItems = $stmtItems->fetchAll() ?: [];
        $refundAmount = 0.00;
        foreach ($retItems as $item) {
            $isWholesale = ($item['ordered_qty'] >= $item['quantity']); 
            $unitPrice = floatval($item['wholesale_price'] ?: $item['price']);
            $refundAmount += $unitPrice * intval($item['quantity']);
        }
        try {
            $db->beginTransaction();
            $stmtUp = $db->prepare("UPDATE returns SET status = 'COMPLETED' WHERE id = ?");
            $stmtUp->execute([$returnId]);
            $stmtRefund = $db->prepare("
                INSERT INTO refunds (return_id, amount, payment_method, status)
                VALUES (?, ?, 'WALLET', 'SUCCESS')
            ");
            $stmtRefund->execute([$returnId, $refundAmount]);
            $stmtUpProfile = $db->prepare("UPDATE retailer_profiles SET balance = balance + ? WHERE user_id = ?");
            $stmtUpProfile->execute([$refundAmount, $return['buyer_id']]);
            $stmtUpWallet = $db->prepare("UPDATE wallets SET balance = balance + ? WHERE user_id = ?");
            $stmtUpWallet->execute([$refundAmount, $return['buyer_id']]);
            $stmtWalletId = $db->prepare("SELECT id FROM wallets WHERE user_id = ?");
            $stmtWalletId->execute([$return['buyer_id']]);
            $walletId = $stmtWalletId->fetchColumn();
            $stmtTx = $db->prepare("
                INSERT INTO wallet_transactions (wallet_id, type, amount, description, reference_type, reference_id, balance_after)
                VALUES (?, 'CREDIT', ?, ?, 'ORDER_REFUND', ?, (SELECT balance FROM wallets WHERE id = ?))
            ");
            $stmtTx->execute([$walletId, $refundAmount, "Refund credit for Return #{$return['return_number']}", $returnId, $walletId]);
            $commRate = floatval($return['commission_rate'] ?? 8.50);
            $commissionDeducted = ($refundAmount * $commRate) / 100.00;
            $taxDeducted = ($refundAmount * 5.00) / 100.00;
            $netSellerDeduction = $refundAmount - $commissionDeducted - $taxDeducted;
            $stmtDownSeller = $db->prepare("UPDATE seller_profiles SET balance = GREATEST(0.00, balance - ?) WHERE user_id = ?");
            $stmtDownSeller->execute([$netSellerDeduction, $user['id']]);
            $stmtDownWallet = $db->prepare("UPDATE wallets SET balance = GREATEST(0.00, balance - ?) WHERE user_id = ?");
            $stmtDownWallet->execute([$netSellerDeduction, $user['id']]);
            $stmtSellerWalletId = $db->prepare("SELECT id FROM wallets WHERE user_id = ?");
            $stmtSellerWalletId->execute([$user['id']]);
            $sellerWalletId = $stmtSellerWalletId->fetchColumn();
            $stmtTxSeller = $db->prepare("
                INSERT INTO wallet_transactions (wallet_id, type, amount, description, reference_type, reference_id, balance_after)
                VALUES (?, 'DEBIT', ?, ?, 'ORDER_REFUND', ?, (SELECT balance FROM wallets WHERE id = ?))
            ");
            $stmtTxSeller->execute([$sellerWalletId, $netSellerDeduction, "Refund debit reversal for Return #{$return['return_number']}", $returnId, $sellerWalletId]);
            $db->commit();
            $response->redirect('/seller/returns');
            return;
        } catch (\Throwable $e) {
            $db->rollBack();
            $_SESSION['return_verify_error'] = 'Failed to process refund: ' . $e->getMessage();
            $response->redirect('/seller/returns');
        }
    }
    public function adminRefund(Request $request, Response $response, array $params) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN']);
        if (!$user) return;
        $returnId = intval($params['id'] ?? 0);
        $db = Application::$app->db;
        $stmtSellerId = $db->prepare("
            SELECT o.seller_id FROM returns r JOIN orders o ON r.order_id = o.id WHERE r.id = ?
        ");
        $stmtSellerId->execute([$returnId]);
        $sellerId = $stmtSellerId->fetchColumn();
        if ($sellerId) {
            $_SESSION['temp_seller_verify'] = true;
            $this->sellerVerify($request, $response, $params);
            unset($_SESSION['temp_seller_verify']);
        } else {
            $response->redirect('/admin');
        }
    }
}
