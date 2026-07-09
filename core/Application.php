<?php

namespace Core;

class Application {
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    public Cache $cache;
    public ?array $sessionUser = null;
    public array $config = [];

    public function __construct() {
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        
        if (session_status() === PHP_SESSION_NONE) {
            session_name('PAVITRASESSID');
            session_set_cookie_params(86400 * 30, '/');
            session_start();
        }

        $this->ensureCsrfToken();
        $this->applySecurityHeaders();

        $this->db = new Database();
        $this->cache = new Cache();
        $this->loadEnv();
        $this->loadConfig();
    }

    public function run(): void {
        try {
            echo $this->router->resolve();
        } catch (\Throwable $e) {
            $this->handleException($e);
        }
    }

    public function getCsrfToken(): string {
        return $_SESSION['csrf_token'] ?? '';
    }

    public function validateCsrfToken(?string $token): bool {
        $sessionToken = $_SESSION['csrf_token'] ?? '';
        return !empty($sessionToken) && is_string($token) && hash_equals($sessionToken, $token);
    }

    protected function ensureCsrfToken(): void {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }

    protected function applySecurityHeaders(): void {
        if (headers_sent()) {
            return;
        }

        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('Permissions-Policy: geolocation=(), microphone=(self), camera=(self)');
        header('Cross-Origin-Opener-Policy: same-origin');
        header('Cross-Origin-Resource-Policy: same-origin');
        header("Content-Security-Policy: default-src 'self' https: data: blob:; script-src 'self' 'unsafe-inline' 'unsafe-eval' https:; style-src 'self' 'unsafe-inline' https:; font-src 'self' https: data:; img-src 'self' https: data: blob:; media-src 'self' https: data: blob:; connect-src 'self' https:; frame-src 'self' https:;");
    }

    public function getSessionUser(): ?array {
        if ($this->sessionUser) {
            return $this->sessionUser;
        }
        
        if (isset($_SESSION['user_id'])) {
            $stmt = $this->db->prepare("SELECT u.*, r.name as role FROM users u JOIN roles r ON u.role_id = r.id WHERE u.id = ? AND u.status = 'ACTIVE'");
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($user) {
                unset($user['password_hash']);
                $this->sessionUser = $user;
                return $user;
            } else {
                unset($_SESSION['user_id']);
            }
        }
        return null;
    }

    public function loadConfig(): void {
        try {
            $stmt = $this->db->query("SELECT setting_key, setting_value FROM system_settings");
            $settings = $stmt->fetchAll(\PDO::FETCH_KEY_PAIR) ?: [];
            $this->config = $settings;
        } catch (\PDOException $e) {
            $this->config = [
                'company_name' => 'Pavitra Designer',
                'brand_name' => 'Pavitra Designer',
                'support_email' => 'p14115419@gmail.com',
                'support_mobile' => '+91 9999999999',
            ];
        }
    }

    public function loadEnv(): void {
        $envPath = dirname(__DIR__) . '/.env';
        if (file_exists($envPath)) {
            $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (str_starts_with(trim($line), '#')) continue;
                if (str_contains($line, '=')) {
                    list($name, $value) = explode('=', $line, 2);
                    $name = trim($name);
                    $value = trim($value, ' "\'');
                    if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                        putenv(sprintf('%s=%s', $name, $value));
                        $_ENV[$name] = $value;
                        $_SERVER[$name] = $value;
                    }
                }
            }
        }
    }

    public function handleException(\Throwable $e): void {
        $userId = $_SESSION['user_id'] ?? null;
        $url = $_SERVER['REQUEST_URI'] ?? '';
        $message = $e->getMessage();
        $file = $e->getFile();
        $line = $e->getLine();
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $browser = $_SERVER['HTTP_USER_AGENT'] ?? '';

        try {
            $stmt = $this->db->prepare("
                INSERT INTO error_logs (message, url, file_name, line_number, user_id, ip_address, browser) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$message, $url, $file, $line, $userId, $ip, $browser]);
        } catch (\Throwable $dbEx) {
            error_log("Error log insertion failed: " . $dbEx->getMessage());
        }

        error_log($e);

        if (($e instanceof \PDOException || str_contains($message, 'Database connection')) && file_exists(dirname(__DIR__) . '/public/install.php')) {
            $this->response->redirect('/install.php');
            return;
        }

        $this->response->setStatusCode(500);
        if (file_exists(dirname(__DIR__) . '/public/php-error.php')) {
            $this->response->redirect('/php-error.php');
        } else {
            echo "<h1>500 Internal Server Error</h1><p>An unexpected error occurred. The administrator has been notified.</p>";
        }
    }

    public static function assetUrl(string $path): string {
        $prefix = self::$app->config['cdn_prefix'] ?? '';
        if (!empty($prefix)) {
            return rtrim($prefix, '/') . '/' . ltrim($path, '/');
        }
        return $path;
    }
}

