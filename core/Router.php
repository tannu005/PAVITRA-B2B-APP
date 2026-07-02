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

        if ($method === 'POST' && !str_starts_with($path, '/api/')) {
            $this->enforceCsrf();
        }
        
        // Find matching route
        $callback = $this->routes[$method][$path] ?? null;
        $params = [];

        if (!$callback) {
            // Dynamic parameter matching: e.g., /product/{id}
            foreach ($this->routes[$method] ?? [] as $routePath => $routeCallback) {
                // Convert route path to regex: /product/{id} -> ^/product/(?P<id>[^/]+)$
                $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $routePath);
                $pattern = '#^' . $pattern . '$#';
                
                if (preg_match($pattern, $path, $matches)) {
                    $callback = $routeCallback;
                    // Extract named parameters
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
            // Controller instantiation: [$class, $method]
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
}
