<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Application;

class SupportController extends Controller {

    public function __construct() {
        $this->setLayout('main');
    }

    // Retailer: list tickets
    public function index(Request $request, Response $response) {
        $user = $this->checkAuth(['RETAILER']);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT * FROM support_tickets WHERE user_id = ? ORDER BY id DESC");
        $stmt->execute([$user['id']]);
        $tickets = $stmt->fetchAll() ?: [];

        return $this->render('retailer/support/list', [
            'title' => 'My Support Tickets - Viraasat B2B',
            'tickets' => $tickets
        ]);
    }

    // Retailer: show create ticket page
    public function createView(Request $request, Response $response) {
        $user = $this->checkAuth(['RETAILER']);
        if (!$user) return;

        return $this->render('retailer/support/create', [
            'title' => 'Open New Ticket - Viraasat B2B'
        ]);
    }

    // Retailer: save new ticket
    public function create(Request $request, Response $response) {
        $user = $this->checkAuth(['RETAILER']);
        if (!$user) return;

        $body = $request->getBody();
        $subject = trim($body['subject'] ?? '');
        $message = trim($body['message'] ?? '');
        $priority = trim($body['priority'] ?? 'LOW');

        $errors = [];
        if (empty($subject)) $errors[] = 'Subject is required.';
        if (empty($message)) $errors[] = 'Description message is required.';
        if (!in_array($priority, ['LOW', 'MEDIUM', 'HIGH', 'CRITICAL'])) $priority = 'LOW';

        $db = Application::$app->db;

        if (empty($errors)) {
            try {
                $db->beginTransaction();

                $ticketNum = 'TCK-' . strtoupper(bin2hex(random_bytes(4))) . '-' . time();
                
                // Insert ticket
                $stmt = $db->prepare("
                    INSERT INTO support_tickets (ticket_number, user_id, subject, status, priority)
                    VALUES (?, ?, ?, 'OPEN', ?)
                ");
                $stmt->execute([$ticketNum, $user['id'], $subject, $priority]);
                $ticketId = $db->lastInsertId();

                // Insert message
                $stmtMsg = $db->prepare("
                    INSERT INTO ticket_messages (ticket_id, sender_id, message, is_internal)
                    VALUES (?, ?, ?, 0)
                ");
                $stmtMsg->execute([$ticketId, $user['id'], $message]);

                $db->commit();
                $response->redirect('/support');
                return;
            } catch (\Throwable $e) {
                $db->rollBack();
                $errors[] = 'Failed to create support ticket: ' . $e->getMessage();
            }
        }

        return $this->render('retailer/support/create', [
            'title' => 'Open New Ticket - Viraasat B2B',
            'errors' => $errors,
            'subject' => $subject,
            'message' => $message,
            'priority' => $priority
        ]);
    }

    // Retailer: view single ticket chat
    public function viewTicket(Request $request, Response $response, array $params) {
        $user = $this->checkAuth(['RETAILER']);
        if (!$user) return;

        $ticketId = intval($params['id'] ?? 0);
        $db = Application::$app->db;

        // Fetch ticket
        $stmt = $db->prepare("SELECT * FROM support_tickets WHERE id = ? AND user_id = ?");
        $stmt->execute([$ticketId, $user['id']]);
        $ticket = $stmt->fetch();

        if (!$ticket) {
            $response->setStatusCode(404);
            return $this->render('_404', ['title' => 'Ticket Not Found']);
        }

        // Fetch messages (exclude internal notes for retailer)
        $stmtMsg = $db->prepare("
            SELECT tm.*, u.name as sender_name, r.name as sender_role
            FROM ticket_messages tm
            JOIN users u ON tm.sender_id = u.id
            JOIN roles r ON u.role_id = r.id
            WHERE tm.ticket_id = ? AND tm.is_internal = 0
            ORDER BY tm.id ASC
        ");
        $stmtMsg->execute([$ticketId]);
        $messages = $stmtMsg->fetchAll() ?: [];

        return $this->render('retailer/support/view', [
            'title' => "Ticket #{$ticket['ticket_number']}",
            'ticket' => $ticket,
            'messages' => $messages
        ]);
    }

    // Retailer: reply to ticket
    public function reply(Request $request, Response $response, array $params) {
        $user = $this->checkAuth(['RETAILER']);
        if (!$user) return;

        $ticketId = intval($params['id'] ?? 0);
        $body = $request->getBody();
        $message = trim($body['message'] ?? '');

        if (empty($message)) {
            $response->redirect("/support/ticket/{$ticketId}");
            return;
        }

        $db = Application::$app->db;
        
        // Verify ownership
        $stmtCheck = $db->prepare("SELECT id FROM support_tickets WHERE id = ? AND user_id = ? AND status != 'CLOSED'");
        $stmtCheck->execute([$ticketId, $user['id']]);
        if (!$stmtCheck->fetch()) {
            $response->redirect('/support');
            return;
        }

        // Insert message & update ticket updated_at / open status
        $stmtMsg = $db->prepare("
            INSERT INTO ticket_messages (ticket_id, sender_id, message, is_internal)
            VALUES (?, ?, ?, 0)
        ");
        $stmtMsg->execute([$ticketId, $user['id'], $message]);

        $stmtUp = $db->prepare("UPDATE support_tickets SET status = 'OPEN' WHERE id = ?");
        $stmtUp->execute([$ticketId]);

        $response->redirect("/support/ticket/{$ticketId}");
    }

    // Admin: list all tickets
    public function adminIndex(Request $request, Response $response) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN', 'SUPPORT_MANAGER']);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->query("
            SELECT st.*, u.name as buyer_name, u.email as buyer_email
            FROM support_tickets st
            JOIN users u ON st.user_id = u.id
            ORDER BY st.id DESC
        ");
        $tickets = $stmt->fetchAll() ?: [];

        return $this->render('admin/support/list', [
            'title' => 'Helpdesk Support Queue - Viraasat B2B',
            'tickets' => $tickets
        ]);
    }

    // Admin: view ticket details workspace
    public function adminViewTicket(Request $request, Response $response, array $params) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN', 'SUPPORT_MANAGER']);
        if (!$user) return;

        $ticketId = intval($params['id'] ?? 0);
        $db = Application::$app->db;

        // Fetch ticket details
        $stmt = $db->prepare("
            SELECT st.*, u.name as buyer_name, u.email as buyer_email, u.mobile as buyer_mobile
            FROM support_tickets st
            JOIN users u ON st.user_id = u.id
            WHERE st.id = ?
        ");
        $stmt->execute([$ticketId]);
        $ticket = $stmt->fetch();

        if (!$ticket) {
            $response->setStatusCode(404);
            return $this->render('_404', ['title' => 'Ticket Not Found']);
        }

        // Fetch messages (include internal notes)
        $stmtMsg = $db->prepare("
            SELECT tm.*, u.name as sender_name, r.name as sender_role
            FROM ticket_messages tm
            JOIN users u ON tm.sender_id = u.id
            JOIN roles r ON u.role_id = r.id
            WHERE tm.ticket_id = ?
            ORDER BY tm.id ASC
        ");
        $stmtMsg->execute([$ticketId]);
        $messages = $stmtMsg->fetchAll() ?: [];

        return $this->render('admin/support/view', [
            'title' => "Admin Workspace - Ticket #{$ticket['ticket_number']}",
            'ticket' => $ticket,
            'messages' => $messages
        ]);
    }

    // Admin: reply or insert internal note
    public function adminReply(Request $request, Response $response, array $params) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN', 'SUPPORT_MANAGER']);
        if (!$user) return;

        $ticketId = intval($params['id'] ?? 0);
        $body = $request->getBody();
        $message = trim($body['message'] ?? '');
        $isInternal = intval($body['is_internal'] ?? 0);

        if (empty($message)) {
            $response->redirect("/admin/support/ticket/{$ticketId}");
            return;
        }

        $db = Application::$app->db;

        // Insert reply
        $stmtMsg = $db->prepare("
            INSERT INTO ticket_messages (ticket_id, sender_id, message, is_internal)
            VALUES (?, ?, ?, ?)
        ");
        $stmtMsg->execute([$ticketId, $user['id'], $message, $isInternal]);

        // Auto transition status if customer reply
        if (!$isInternal) {
            $stmtUp = $db->prepare("UPDATE support_tickets SET status = 'IN_PROGRESS' WHERE id = ?");
            $stmtUp->execute([$ticketId]);
        }

        $response->redirect("/admin/support/ticket/{$ticketId}");
    }

    // Admin: update ticket status manually
    public function adminStatus(Request $request, Response $response, array $params) {
        $user = $this->checkAuth(['SUPER_ADMIN', 'ADMIN', 'SUPPORT_MANAGER']);
        if (!$user) return;

        $ticketId = intval($params['id'] ?? 0);
        $body = $request->getBody();
        $status = trim($body['status'] ?? 'RESOLVED');

        if (!in_array($status, ['OPEN', 'IN_PROGRESS', 'RESOLVED', 'CLOSED'])) {
            $status = 'RESOLVED';
        }

        $db = Application::$app->db;
        $stmt = $db->prepare("UPDATE support_tickets SET status = ? WHERE id = ?");
        $stmt->execute([$status, $ticketId]);

        $response->redirect("/admin/support/ticket/{$ticketId}");
    }
}
