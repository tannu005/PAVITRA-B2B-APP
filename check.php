<?php
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/';
    $prefixes = [
        'Core\\' => 'core/',
        'App\\' => 'src/'
    ];
    foreach ($prefixes as $prefix => $dir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }
        $relativeClass = substr($class, $len);
        $file = $baseDir . $dir . str_replace('\\', '/', $relativeClass) . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
});

$app = new Core\Application();
$db = $app->db;

try {
    echo "Products: " . $db->query("SELECT count(*) FROM products")->fetchColumn() . "\n";
    echo "Variants: " . $db->query("SELECT count(*) FROM product_variants")->fetchColumn() . "\n";
    echo "Images: " . $db->query("SELECT count(*) FROM product_images")->fetchColumn() . "\n";
    
    $sql = "
            SELECT p.*, 
                   MIN(pv.id) as variant_id, 
                   (SELECT pi.image_url FROM product_images pi WHERE pi.product_id = p.id AND pi.is_primary = 0 ORDER BY pi.id ASC LIMIT 1) as hover_image_url
            FROM products p 
            JOIN product_variants pv ON pv.product_id = p.id
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.status = 'ACTIVE'
            GROUP BY p.id
            ORDER BY p.id DESC
            LIMIT 10
        ";
    $stmt = $db->query($sql);
    $products = $stmt->fetchAll();
    echo "Query successful. Products fetched: " . count($products) . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
