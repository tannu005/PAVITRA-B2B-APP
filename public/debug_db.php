<?php
spl_autoload_register(function ($class) {
    $file = dirname(__DIR__) . '/src/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
$app = new \Core\Application();
$db = $app->db;
$products = $db->query("SELECT p.title, v.image_url FROM products p LEFT JOIN product_variants v ON p.id = v.product_id LIMIT 10")->fetchAll();
echo json_encode($products);
