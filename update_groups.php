<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'] ?? '127.0.0.1';
$port = $_ENV['DB_PORT'] ?? '3306';
$dbName = $_ENV['DB_DATABASE'] ?? 'meesho';
$user = $_ENV['DB_USERNAME'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbName;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $occasion = ['Wedding Wear', 'Party Wear', 'Festival Wear', 'Office Wear', 'Daily Wear', 'Reception Collection', 'Haldi Collection', 'Mehndi Collection'];
    $fabric = ['Pure Silk', 'Soft Silk', 'Cotton Silk', 'Pure Cotton', 'Mulmul Cotton', 'Georgette', 'Chiffon', 'Organza', 'Tissue', 'Linen', 'Crepe', 'Net', 'Satin'];

    $stmt = $pdo->query("SELECT id, name FROM categories");
    while ($cat = $stmt->fetch()) {
        $name = $cat['name'];
        $group = 'Categories';
        if (in_array($name, $occasion)) {
            $group = 'Shop by Occasion';
        } elseif (in_array($name, $fabric)) {
            $group = 'Fabric';
        }

        $pdo->prepare("UPDATE categories SET group_name = ? WHERE id = ?")->execute([$group, $cat['id']]);
    }
    echo "Groups updated!\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
