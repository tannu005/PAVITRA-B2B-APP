<?php
namespace Core;
class Response {
    public function setStatusCode(int $code): void {
        http_response_code($code);
    }
    public function redirect(string $url): void {
        header("Location: $url");
        exit;
    }
    public function json(array $data, int $statusCode = 200): void {
        $this->setStatusCode($statusCode);
        header('Content-Type: application/json');
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        echo json_encode($data);
        exit;
    }
}
