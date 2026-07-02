<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Application;

class DeliveryController extends Controller {

    public function __construct() {
        $this->setLayout('main');
    }

    // Driver Dashboard
    public function dashboard(Request $request, Response $response) {
        $user = $this->checkAuth(['DELIVERY']);
        if (!$user) return;

        $db = Application::$app->db;

        // Fetch driver wallet earnings
        $stmtBalance = $db->prepare("SELECT balance FROM delivery_partner_profiles WHERE user_id = ?");
        $stmtBalance->execute([$user['id']]);
        $balance = $stmtBalance->fetchColumn() ?: 0.00;

        // Fetch assigned orders/shipments
        $stmtAssignments = $db->prepare("
            SELECT da.id as assignment_id, da.status as assignment_status, 
                   s.shipment_number, o.id as order_id, o.order_number, o.net_amount,
                   buyer.name as buyer_name, buyer.mobile as buyer_mobile,
                   seller.name as seller_name,
                   dp.otp_code
            FROM delivery_assignments da
            JOIN shipments s ON da.shipment_id = s.id
            JOIN orders o ON s.order_id = o.id
            JOIN users buyer ON o.user_id = buyer.id
            JOIN users seller ON o.seller_id = seller.id
            LEFT JOIN delivery_proofs dp ON dp.delivery_assignment_id = da.id
            WHERE da.delivery_partner_id = ? AND da.status != 'DELIVERED'
            ORDER BY da.id DESC
        ");
        $stmtAssignments->execute([$user['id']]);
        $activeAssignments = $stmtAssignments->fetchAll() ?: [];

        return $this->render('delivery/dashboard', [
            'title' => 'Courier Logistics Hub',
            'balance' => $balance,
            'assignments' => $activeAssignments,
            'user' => $user
        ]);
    }

    // Change delivery assignment status (e.g. PICKED_UP or OUT_FOR_DELIVERY)
    public function updateDeliveryStatus(Request $request, Response $response) {
        $user = $this->checkAuth(['DELIVERY']);
        if (!$user) return;

        $body = $request->getBody();
        $assignId = intval($body['assignment_id'] ?? 0);
        $newStatus = trim($body['status'] ?? '');

        $allowedStatuses = ['PICKED_UP', 'OUT_FOR_DELIVERY'];
        if ($assignId <= 0 || !in_array($newStatus, $allowedStatuses)) {
            return $response->json(['error' => 'Invalid parameters'], 400);
        }

        $db = Application::$app->db;

        // Check ownership
        $stmt = $db->prepare("SELECT id, shipment_id FROM delivery_assignments WHERE id = ? AND delivery_partner_id = ?");
        $stmt->execute([$assignId, $user['id']]);
        $assignment = $stmt->fetch();

        if (!$assignment) {
            return $response->json(['error' => 'Permission denied'], 403);
        }

        try {
            $db->beginTransaction();

            // Update assignment status
            $stmtUp = $db->prepare("UPDATE delivery_assignments SET status = ? WHERE id = ?");
            $stmtUp->execute([$newStatus, $assignId]);

            // Map assignment status to Order status
            $mappedOrderStatus = $newStatus === 'PICKED_UP' ? 'SHIPPED' : 'OUT_FOR_DELIVERY';

            // Find order linked to shipment
            $stmtOrder = $db->prepare("SELECT order_id FROM shipments WHERE id = ?");
            $stmtOrder->execute([$assignment['shipment_id']]);
            $orderId = $stmtOrder->fetchColumn();

            if ($orderId) {
                // Update Order Status
                $stmtUpOrder = $db->prepare("UPDATE orders SET status = ? WHERE id = ?");
                $stmtUpOrder->execute([$mappedOrderStatus, $orderId]);

                // Insert order status history log
                $stmtHistory = $db->prepare("
                    INSERT INTO order_status_history (order_id, status, comments, created_by)
                    VALUES (?, ?, ?, ?)
                ");
                $stmtHistory->execute([$orderId, $mappedOrderStatus, "Status advanced by delivery rider", $user['id']]);
            }

            $db->commit();
            return $response->json(['success' => true]);

        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'Transit status update failed: ' . $e->getMessage()], 500);
        }
    }

    // Verify OTP and complete delivery handover
    public function verifyDeliveryOtp(Request $request, Response $response) {
        $user = $this->checkAuth(['DELIVERY']);
        if (!$user) return;

        $body = $request->getBody();
        $assignId = intval($body['assignment_id'] ?? 0);
        $otp = trim($body['otp'] ?? '');

        if ($assignId <= 0 || empty($otp)) {
            return $response->json(['error' => 'Please provide the 4-digit customer handover OTP.'], 400);
        }

        $db = Application::$app->db;

        // Verify assignment & OTP matching
        $stmt = $db->prepare("
            SELECT da.id, da.shipment_id, dp.otp_code 
            FROM delivery_assignments da
            JOIN delivery_proofs dp ON dp.delivery_assignment_id = da.id
            WHERE da.id = ? AND da.delivery_partner_id = ?
        ");
        $stmt->execute([$assignId, $user['id']]);
        $proof = $stmt->fetch();

        if (!$proof) {
            return $response->json(['error' => 'Logistics assignment not found.'], 404);
        }

        if ($proof['otp_code'] !== $otp) {
            return $response->json(['error' => 'Incorrect handover OTP. Please verify with boutique owner.'], 400);
        }

        try {
            $db->beginTransaction();

            $now = date('Y-m-d H:i:s');

            // 1. Update delivery assignment
            $stmtUp = $db->prepare("UPDATE delivery_assignments SET status = 'DELIVERED', completed_at = ? WHERE id = ?");
            $stmtUp->execute([$now, $assignId]);

            // 2. Update delivery proofs
            $stmtUpProof = $db->prepare("UPDATE delivery_proofs SET verified_at = ? WHERE delivery_assignment_id = ?");
            $stmtUpProof->execute([$now, $assignId]);

            // 3. Find order linked to shipment
            $stmtOrder = $db->prepare("SELECT order_id FROM shipments WHERE id = ?");
            $stmtOrder->execute([$proof['shipment_id']]);
            $orderId = $stmtOrder->fetchColumn();

            if ($orderId) {
                // Update Order Status
                $stmtUpOrder = $db->prepare("UPDATE orders SET status = 'DELIVERED' WHERE id = ?");
                $stmtUpOrder->execute([$orderId]);

                // Insert history log
                $stmtHistory = $db->prepare("
                    INSERT INTO order_status_history (order_id, status, comments, created_by)
                    VALUES (?, 'DELIVERED', 'Successful OTP verified handover to boutique owner', ?)
                ");
                $stmtHistory->execute([$orderId, $user['id']]);
            }

            // 4. Pay courier rider delivery payout (e.g. ₹150.00 mock delivery payout)
            $riderPayout = 150.00;
            $stmtRider = $db->prepare("UPDATE delivery_partner_profiles SET balance = balance + ? WHERE user_id = ?");
            $stmtRider->execute([$riderPayout, $user['id']]);

            // Add wallet transaction for driver
            $stmtUpDriverWallet = $db->prepare("UPDATE wallets SET balance = balance + ? WHERE user_id = ?");
            $stmtUpDriverWallet->execute([$riderPayout, $user['id']]);

            $stmtDriverWalletId = $db->prepare("SELECT id FROM wallets WHERE user_id = ?");
            $stmtDriverWalletId->execute([$user['id']]);
            $driverWalletId = $stmtDriverWalletId->fetchColumn();

            $stmtTx = $db->prepare("
                INSERT INTO wallet_transactions (wallet_id, type, amount, description, reference_type, reference_id, balance_after)
                VALUES (?, 'CREDIT', ?, ?, 'DELIVERY_PAYOUT', ?, (SELECT balance FROM wallets WHERE id = ?))
            ");
            $stmtTx->execute([$driverWalletId, $riderPayout, "Delivery rider payout for shipment handover", $assignId, $driverWalletId]);

            $db->commit();
            return $response->json(['success' => true]);

        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'Logistics handover execution crashed: ' . $e->getMessage()], 500);
        }
    }
}

