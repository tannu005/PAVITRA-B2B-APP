<?php

namespace Core;

class Router {
    protected array $routes = [];
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, $callback): void {
        $this->routes['GET'][$this->normalizePath($path)] = $callback;
    }

    public function post(string $path, $callback): void {
        $this->routes['POST'][$this->normalizePath($path)] = $callback;
    }

    protected function normalizePath(string $path): string {
        $path = trim($path, '/');
        return $path === '' ? '/' : '/' . $path;
    }

    public function resolve() {
        $path = $this->normalizePath($this->request->getPath());
        $method = $this->request->getMethod();

        if (str_starts_with($path, '/api/')) {
            if (!$this->checkRateLimit()) {
                $this->response->setStatusCode(429);
                header('Content-Type: application/json');
                header('Retry-After: 60');
                echo json_encode([
                    'error' => 'Too Many Requests',
                    'message' => 'API rate limit exceeded. Max 100 requests per minute.'
                ]);
                exit;
            }
        }

        if ($method === 'POST' && !str_starts_with($path, '/api/')) {
            $this->enforceCsrf();
        }
        
        $callback = $this->routes[$method][$path] ?? null;
        $params = [];

        if (!$callback) {
            foreach ($this->routes[$method] ?? [] as $routePath => $routeCallback) {
                $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $routePath);
                $pattern = '#^' . $pattern . '$#';
                
                if (preg_match($pattern, $path, $matches)) {
                    $callback = $routeCallback;
                    foreach ($matches as $key => $value) {
                        if (is_string($key)) {
                            $params[$key] = $value;
                        }
                    }
                    break;
                }
            }
        }

        if (!$callback) {
            $this->response->setStatusCode(404);
            return $this->renderView('_404', ['title' => 'Page Not Found']);
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $controllerClass = $callback[0];
            $controllerMethod = $callback[1];
            
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();
                return call_user_func_array([$controller, $controllerMethod], [$this->request, $this->response, $params]);
            }
        }

        if (is_callable($callback)) {
            return call_user_func_array($callback, [$this->request, $this->response, $params]);
        }

        $this->response->setStatusCode(500);
        return 'Internal Server Error';
    }

    protected function enforceCsrf(): void {
        $body = $this->request->getBody();
        $token = $body['csrf_token'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');

        if (!Application::$app->validateCsrfToken(is_string($token) ? $token : null)) {
            $sessionToken = $_SESSION['csrf_token'] ?? 'EMPTY_SESSION_TOKEN';
            file_put_contents(__DIR__ . '/../csrf_debug.log', "CSRF FAILED. POST Token: {$token} | Session Token: {$sessionToken} | POST BODY: " . json_encode($body) . "\n", FILE_APPEND);
            $this->response->setStatusCode(419);
            echo 'CSRF token validation failed.';
            exit;
        }
    }

    public function renderView(string $view, array $params = []) {
        $layoutContent = $this->layoutContent($params);
        $viewContent = $this->renderViewOnly($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent(array $params) {
        $layout = $params['layout'] ?? 'main';
        $layoutFile = dirname(__DIR__) . "/src/Views/layouts/{$layout}.php";
        if (!file_exists($layoutFile)) {
            $layoutFile = dirname(__DIR__) . "/src/Views/layouts/main.php";
        }
        
        ob_start();
        include_once $layoutFile;
        return ob_get_clean();
    }

    protected function renderViewOnly(string $view, array $params) {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        
        $viewFile = dirname(__DIR__) . "/src/Views/{$view}.php";
        if (!file_exists($viewFile)) {
            return "View [{$view}] not found.";
        }

        ob_start();
        include_once $viewFile;
        return ob_get_clean();
    }

    protected function checkRateLimit(): bool {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        $currentTime = time();
        $rateLimitKey = 'rate_limit_' . md5($ip);
        
        $cache = Application::$app->cache;
        $bucket = $cache->get($rateLimitKey);
        
        if (!$bucket || !is_array($bucket) || !isset($bucket['tokens']) || !isset($bucket['last_updated'])) {
            $bucket = [
                'tokens' => 100.0,
                'last_updated' => $currentTime
            ];
        } else {
            $elapsedTime = max(0, $currentTime - $bucket['last_updated']);
            $tokensToAdd = $elapsedTime * (100.0 / 60.0);
            $bucket['tokens'] = min(100.0, floatval($bucket['tokens']) + $tokensToAdd);
            $bucket['last_updated'] = $currentTime;
        }

        header('X-RateLimit-Limit: 100');

        if ($bucket['tokens'] >= 1.0) {
            $bucket['tokens'] -= 1.0;
            $cache->set($rateLimitKey, $bucket, 60);
            header('X-RateLimit-Remaining: ' . floor($bucket['tokens']));
            return true;
        }

        $cache->set($rateLimitKey, $bucket, 60);
        header('X-RateLimit-Remaining: 0');

        try {
            $db = Application::$app->db;
            $stmt = $db->prepare("
                INSERT INTO error_logs (message, url, ip_address, browser) 
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([
                "API Rate Limit Exceeded: Throttled request from IP {$ip}",
                $this->normalizePath($this->request->getPath()),
                $ip,
                $_SERVER['HTTP_USER_AGENT'] ?? ''
            ]);
        } catch (\Throwable $e) {
        }

        return false;
    }
}
