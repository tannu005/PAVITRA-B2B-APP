<?php
require_once __DIR__ . '/../vendor/autoload.php';
$app = new \Core\Application();
$db = $app->db;
$products = $db->query("SELECT p.title, v.image_url FROM products p LEFT JOIN product_variants v ON p.id = v.product_id LIMIT 10")->fetchAll();
echo json_encode($products);
