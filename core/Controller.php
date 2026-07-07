<?php

namespace Core;

class Controller {
    protected string $layout = 'main';

    public function setLayout(string $layout): void {
        $this->layout = $layout;
    }

    public function render(string $view, array $params = []) {
        $params['layout'] = $this->layout;
        return Application::$app->router->renderView($view, $params);
    }

    protected function checkAuth(array $allowedRoles = []): ?array {
        $user = Application::$app->getSessionUser();
        if (!$user) {
            Application::$app->response->redirect('/login');
            return null;
        }

        if (!empty($allowedRoles) && !in_array($user['role'], $allowedRoles)) {
            if ($user['role'] === 'SELLER') {
                Application::$app->response->redirect('/seller');
            } else if ($user['role'] === 'DELIVERY') {
                Application::$app->response->redirect('/delivery');
            } else if (in_array($user['role'], ['SUPER_ADMIN', 'ADMIN'])) {
                Application::$app->response->redirect('/admin');
            } else {
                Application::$app->response->redirect('/');
            }
            return null;
        }

        return $user;
    }
}
