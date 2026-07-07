<?php

namespace Core;

class Notification {
    /**
     * Dispatch a notification to a specific user via specified channels
     */
    public static function send(int $userId, string $title, string $message, array $channels = ['EMAIL']): bool {
        $db = Application::$app->db;

        // 1. Get user details (email and mobile)
        $stmtUser = $db->prepare("SELECT email, mobile FROM users WHERE id = ?");
        $stmtUser->execute([$userId]);
        $user = $stmtUser->fetch();
        if (!$user) {
            return false;
        }

        // 2. Insert into notifications table
        $stmtInsert = $db->prepare("INSERT INTO notifications (user_id, title, message) VALUES (?, ?, ?)");
        $stmtInsert->execute([$userId, $title, $message]);
        $notificationId = $db->lastInsertId();

        $allSuccess = true;

        // Load configs
        $config = Application::$app->config;
        
        foreach ($channels as $channel) {
            $channel = strtoupper($channel);
            if (!in_array($channel, ['SMS', 'EMAIL', 'WHATSAPP'])) {
                continue;
            }

            // Insert pending log
            $stmtLog = $db->prepare("INSERT INTO notification_logs (notification_id, channel, status) VALUES (?, ?, 'PENDING')");
            $stmtLog->execute([$notificationId, $channel]);
            $logId = $db->lastInsertId();

            $status = 'FAILED';

            if ($channel === 'EMAIL') {
                $status = self::sendEmail($user['email'], $title, $message, $config) ? 'SENT' : 'FAILED';
            } else if ($channel === 'SMS') {
                $status = self::sendSms($user['mobile'], $message, $config) ? 'SENT' : 'FAILED';
            } else if ($channel === 'WHATSAPP') {
                $status = self::sendWhatsApp($user['mobile'], $message, $config) ? 'SENT' : 'FAILED';
            }

            // Update status & sent_at
            $sentAt = $status === 'SENT' ? date('Y-m-d H:i:s') : null;
            $stmtUpdate = $db->prepare("UPDATE notification_logs SET status = ?, sent_at = ? WHERE id = ?");
            $stmtUpdate->execute([$status, $sentAt, $logId]);

            if ($status === 'FAILED') {
                $allSuccess = false;
            }
        }

        return $allSuccess;
    }

    /**
     * Send Email via SendGrid v3 API
     */
    protected static function sendEmail(string $toEmail, string $subject, string $messageContent, array $config): bool {
        $apiKey = $config['sendgrid_api_key'] ?? '';
        $fromEmail = $config['sendgrid_from_email'] ?? $config['support_email'] ?? '';
        $brandName = $config['brand_name'] ?? 'Pavitra B2B';

        if (empty($apiKey) || empty($fromEmail)) {
            // Fallback to standard PHP mail() in development/test
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers .= "From: {$brandName} <{$fromEmail}>\r\n";
            return @mail($toEmail, $subject, "<html><body><p>" . nl2br(htmlspecialchars($messageContent)) . "</p></body></html>", $headers);
        }

        $url = 'https://api.sendgrid.com/v3/mail/send';
        $data = [
            'personalizations' => [
                [
                    'to' => [['email' => $toEmail]],
                    'subject' => $subject
                ]
            ],
            'from' => [
                'email' => $fromEmail,
                'name' => $brandName
            ],
            'content' => [
                [
                    'type' => 'text/html',
                    'value' => '<html><body><p>' . nl2br(htmlspecialchars($messageContent)) . '</p></body></html>'
                ]
            ]
        ];

        try {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json'
            ]);
            $response = curl_exec($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return $statusCode >= 200 && $statusCode < 300;
        } catch (\Throwable $e) {
            error_log("SendGrid Email dispatch failed: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send SMS via Twilio Messages API
     */
    protected static function sendSms(string $toMobile, string $messageText, array $config): bool {
        $sid = $config['twilio_sid'] ?? '';
        $token = $config['twilio_auth_token'] ?? '';
        $fromPhone = $config['twilio_phone_number'] ?? '';

        if (empty($sid) || empty($token) || empty($fromPhone)) {
            // Mock logger fallback
            $db = Application::$app->db;
            $stmt = $db->prepare("INSERT INTO sms_logs (phone_number, message, status) VALUES (?, ?, 'SENT')");
            return $stmt->execute([$toMobile, $messageText]);
        }

        $url = "https://api.twilio.com/2010-04-01/Accounts/{$sid}/Messages.json";
        $postData = [
            'To' => $toMobile,
            'From' => $fromPhone,
            'Body' => $messageText
        ];

        try {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_USERPWD, "{$sid}:{$token}");
            $response = curl_exec($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return $statusCode >= 200 && $statusCode < 300;
        } catch (\Throwable $e) {
            error_log("Twilio SMS dispatch failed: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send WhatsApp via Twilio WhatsApp API
     */
    protected static function sendWhatsApp(string $toMobile, string $messageText, array $config): bool {
        $sid = $config['twilio_sid'] ?? '';
        $token = $config['twilio_auth_token'] ?? '';
        $fromPhone = $config['twilio_phone_number'] ?? '';

        if (empty($sid) || empty($token) || empty($fromPhone)) {
            // Mock whatsapp log
            error_log("Mock WhatsApp to {$toMobile}: {$messageText}");
            return true;
        }

        // WhatsApp targets on Twilio must be prefixed with whatsapp:
        $to = str_starts_with($toMobile, 'whatsapp:') ? $toMobile : 'whatsapp:' . $toMobile;
        $from = str_starts_with($fromPhone, 'whatsapp:') ? $fromPhone : 'whatsapp:' . $fromPhone;

        $url = "https://api.twilio.com/2010-04-01/Accounts/{$sid}/Messages.json";
        $postData = [
            'To' => $to,
            'From' => $from,
            'Body' => $messageText
        ];

        try {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_USERPWD, "{$sid}:{$token}");
            $response = curl_exec($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return $statusCode >= 200 && $statusCode < 300;
        } catch (\Throwable $e) {
            error_log("Twilio WhatsApp dispatch failed: " . $e->getMessage());
            return false;
        }
    }
}
