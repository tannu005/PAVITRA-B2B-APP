<?php
namespace Core;

class JWTHandler {
    private string $secret;
    private string $algorithm = 'HS256';
    
    public function __construct() {
  
        $this->secret = $_ENV['APP_KEY'] ?? 'pavitra_super_secret_jwt_key_2026';
    }

    
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

        return base64_encode(json_encode($payload));
    }

    
    public function decodeToken(string $token): ?array {
        if (empty($token)) {
            return null;
        }

        try {
            if (class_exists(\Firebase\JWT\JWT::class) && class_exists(\Firebase\JWT\Key::class)) {
                $decoded = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key($this->secret, $this->algorithm));
                return (array) $decoded->data;
            }

      
            $decoded = json_decode(base64_decode($token), true);
            if (isset($decoded['data']['id'])) {
                if (isset($decoded['exp']) && $decoded['exp'] < time()) {
                    return null; 
                }
                return $decoded['data'];
            }
            return null;
        } catch (\Throwable $e) {
            return null;
        }
    }
}
