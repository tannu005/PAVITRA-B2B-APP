<?php

namespace Core;

class Totp {
    /**
     * Generate a new Base32 secret key for Google Authenticator
     */
    public static function generateSecret(int $length = 16): string {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $secret = '';
        for ($i = 0; $i < $length; $i++) {
            $secret .= $chars[random_int(0, 31)];
        }
        return $secret;
    }

    /**
     * Calculate the one-time password for a secret and time slice
     */
    public static function getOtp(string $secret, ?int $timeSlice = null): string {
        if ($timeSlice === null) {
            $timeSlice = (int) floor(time() / 30);
        }

        $secretUpper = strtoupper($secret);
        $secretUpper = str_replace('=', '', $secretUpper);
        if (empty($secretUpper)) {
            return '';
        }

        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $map = array_flip(str_split($chars));
        $binaryPattern = '';
        foreach (str_split($secretUpper) as $char) {
            if (!isset($map[$char])) {
                continue;
            }
            $binaryPattern .= str_pad(decbin($map[$char]), 5, '0', STR_PAD_LEFT);
        }
        
        $binarySecret = '';
        foreach (str_split($binaryPattern, 8) as $byte) {
            if (strlen($byte) < 8) {
                break;
            }
            $binarySecret .= chr((int) bindec($byte));
        }

        $time = pack('N*', 0) . pack('N*', $timeSlice);

        $hmac = hash_hmac('sha1', $time, $binarySecret, true);

        $offset = ord($hmac[strlen($hmac) - 1]) & 0xf;

        $value = (ord($hmac[$offset]) & 0x7f) << 24 |
            (ord($hmac[$offset + 1]) & 0xff) << 16 |
            (ord($hmac[$offset + 2]) & 0xff) << 8 |
            (ord($hmac[$offset + 3]) & 0xff);

        $otp = $value % 1000000;
        return str_pad((string)$otp, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Verify a submitted TOTP code
     */
    public static function verify(string $secret, string $code, int $discrepancy = 1): bool {
        $currentTimeSlice = (int) floor(time() / 30);
        for ($i = -$discrepancy; $i <= $discrepancy; $i++) {
            $calculatedCode = self::getOtp($secret, $currentTimeSlice + $i);
            if (hash_equals($calculatedCode, $code)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get Google Authenticator QR Code URL
     */
    public static function getQrCodeUrl(string $name, string $secret, string $title = 'Pavitra B2B'): string {
        return 'otpauth://totp/' . rawurlencode($title . ':' . $name) . '?secret=' . $secret . '&issuer=' . rawurlencode($title);
    }
}
