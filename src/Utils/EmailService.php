<?php

namespace App\Utils;

class EmailService {
    public static function send($to, $subject, $htmlContent) {
        $apiKey = $_ENV['SENDGRID_API_KEY'] ?? '';
        $fromEmail = 'p14115419@gmail.com';
        
        if (empty($apiKey) || empty($fromEmail)) {
            return false;
        }

        $styledHtml = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <style>
                body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f5f6; margin: 0; padding: 20px; color: #333; }
                .email-container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
                .email-header { background-color: #e83e8c; color: #ffffff; padding: 20px; text-align: center; }
                .email-header h1 { margin: 0; font-size: 24px; font-weight: bold; }
                .email-body { padding: 30px; line-height: 1.6; }
                .email-footer { background-color: #f8f9fa; padding: 20px; text-align: center; font-size: 12px; color: #888; border-top: 1px solid #eee; }
                .btn { display: inline-block; background-color: #e83e8c; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold; margin-top: 20px; }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='email-header'>
                    <h1>Pavitra Designer Wholesale</h1>
                </div>
                <div class='email-body'>
                    " . $htmlContent . "
                </div>
                <div class='email-footer'>
                    <p>&copy; " . date('Y') . " Pavitra Designer Wholesale. All rights reserved.</p>
                    <p>You are receiving this email because you are opted into our notifications. <br>To update preferences, visit your account settings.</p>
                </div>
            </div>
        </body>
        </html>";

        $data = [
            'personalizations' => [
                [
                    'to' => [['email' => $to]],
                    'subject' => $subject
                ]
            ],
            'from' => ['email' => $fromEmail, 'name' => 'Pavitra B2B'],
            'content' => [
                [
                    'type' => 'text/html',
                    'value' => $styledHtml
                ]
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.sendgrid.com/v3/mail/send');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode >= 200 && $httpCode < 300;
    }
}

