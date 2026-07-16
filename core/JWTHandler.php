<?php
namespace Core;

class JWTHandler {
    private string $secret;
    private string $algorithm = 'HS256';
    
    public function __construct() {
        // Fallback to a hardcoded string if env not loaded
        $this->secret = $_ENV['APP_KEY'] ?? 'pavitra_super_secret_jwt_key_2026';
    }

    /**
     * Generate a JWT token for a user
     */
    public function generateToken(array $user, int $expiryInSeconds = 86400): string {
        $payload = [
            'iss' => $_ENV['APP_URL'] ?? 'https://api.pavitrab2b.com',
            'aud' => $_ENV['APP_URL'] ?? 'https://api.pavitrab2b.com',
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + $expiryInSeconds,
            'data' => [
                'id' => $user['id'],
                'role' => $user['role_id']
            ]
        ];

        if (class_exists(\Firebase\JWT\JWT::class)) {
            return \Firebase\JWT\JWT::encode($payload, $this->secret, $this->algorithm);
        }

        // Mock implementation for local environments without composer
        return base64_encode(json_encode($payload));
    }

    /**
     * Decode a JWT token
     */
    public function decodeToken(string $token): ?array {
        if (empty($token)) {
            return null;
        }

        try {
            if (class_exists(\Firebase\JWT\JWT::class) && class_exists(\Firebase\JWT\Key::class)) {
                $decoded = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key($this->secret, $this->algorithm));
                return (array) $decoded->data;
            }

            // Mock implementation fallback
            $decoded = json_decode(base64_decode($token), true);
            if (isset($decoded['data']['id'])) {
                if (isset($decoded['exp']) && $decoded['exp'] < time()) {
                    return null; // Expired
                }
                return $decoded['data'];
            }
            return null;
        } catch (\Throwable $e) {
            return null;
        }
    }
}
