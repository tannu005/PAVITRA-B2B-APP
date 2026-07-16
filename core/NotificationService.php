<?php
namespace Core;

class NotificationService {
    
    
    public static function dispatch(int $userId, string $title, string $message, array $channels = ['IN_APP']) {
        if (in_array('IN_APP', $channels)) {
            self::saveToDatabase($userId, $title, $message);
        }
        
        if (in_array('SMS', $channels)) {
            self::sendSmsTwilio($userId, $message);
        }
        
        if (in_array('WHATSAPP', $channels)) {
            self::sendWhatsApp($userId, $message);
        }
        
        if (in_array('PUSH', $channels)) {
            self::sendFcmPush($userId, $title, $message);
        }
    }

  
    public static function dispatchOrderPlaced(int $userId, int $orderId, string $total) {
        $title = "Order Confirmed!";
        $message = "Your order #$orderId for ₹$total has been successfully placed. You will be notified when it ships.";
        self::dispatch($userId, $title, $message, ['IN_APP', 'SMS', 'PUSH']);
    }
   
    public static function dispatchKycVerified(int $sellerId) {
        $title = "KYC Approved";
        $message = "Congratulations! Your Master Weaver profile has been verified. You can now upload your catalog.";
        self::dispatch($sellerId, $title, $message, ['IN_APP', 'WHATSAPP', 'PUSH']);
    }

    private static function saveToDatabase(int $userId, string $title, string $message) {
        try {
            $db = Application::$app->db;
            $stmt = $db->prepare("INSERT INTO notifications (user_id, title, message) VALUES (?, ?, ?)");
            $stmt->execute([$userId, $title, $message]);
        } catch (\Throwable $e) {}
    }

    private static function sendSmsTwilio(int $userId, string $message) {
     
        self::logMockDispatch('SMS_TWILIO', $userId, $message);
    }

    private static function sendWhatsApp(int $userId, string $message) {
    
        
        self::logMockDispatch('WHATSAPP_META', $userId, $message);
    }

    private static function sendFcmPush(int $userId, string $title, string $message) {
     
        
        self::logMockDispatch('FCM_PUSH', $userId, "$title: $message");
    }
    
    private static function logMockDispatch(string $type, int $userId, string $payload) {
        try {
            $db = Application::$app->db;
            $stmt = $db->prepare("INSERT INTO activity_logs (activity, details) VALUES (?, ?)");
            $stmt->execute([$type, "Dispatched to UserID: $userId | Payload: $payload"]);
        } catch (\Throwable $e) {}
    }
}
