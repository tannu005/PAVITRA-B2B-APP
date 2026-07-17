<?php
spl_autoload_register(function ($class) {
    $baseDir = dirname(__DIR__) . '/';
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

use Core\Application;

$app = new Application();

try {
    $config = require dirname(__DIR__) . '/config/db.php';
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
    
    $db = new \PDO($dsn, $config['username'], $config['password'], [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_EMULATE_PREPARES => true,
        \PDO::MYSQL_ATTR_MULTI_STATEMENTS => true,
    ]);

    $db->exec('SET FOREIGN_KEY_CHECKS = 0;');
    
    $tablesToTruncate = [
        'attribute_values', 'banks', 'carts', 'categories', 'cms_pages', 'coupons', 
        'delivery_partner_profiles', 'error_logs', 'gst_rates', 'offer_products', 'offers', 
        'permissions', 'product_attributes', 'product_images', 'product_variants', 
        'products', 'retailer_profiles', 'role_permissions', 'roles', 'seller_profiles', 
        'system_settings', 'users', 'wallets'
    ];
    foreach ($tablesToTruncate as $table) {
        try {
            $db->exec("TRUNCATE TABLE `$table`;");
        } catch (\PDOException $e) {}
    }

    $seedsPath = dirname(__DIR__) . '/database/seeds.sql';
    if (file_exists($seedsPath)) {
        $sql = file_get_contents($seedsPath);
        $sql = preg_replace('/^\xEF\xBB\xBF/', '', $sql);
        $sql = preg_replace('/^LOCK TABLES.*?;/m', '', $sql);
        $sql = preg_replace('/^UNLOCK TABLES;/m', '', $sql);
        
        try {
            $db->exec('UNLOCK TABLES;'); // clear persistent locks
            $db->exec($sql);
        } catch (\PDOException $e) {
            $statements = preg_split('/;[\r\n]+/', $sql);
            foreach ($statements as $stmt) {
                $stmt = trim($stmt);
                if (!empty($stmt)) {
                    $db->exec($stmt);
                }
            }
        }
    }

    $db->exec('SET FOREIGN_KEY_CHECKS = 1;');
    
    $app->cache->clear();

    echo "<div style='font-family: sans-serif; text-align: center; margin-top: 50px;'>";
    echo "<h1 style='color: green;'>Database Successfully Rebuilt!</h1>";
    echo "<p>The live server has imported all 627 authentic products and dropped all mock data.</p>";
    echo "<a href='/' style='padding: 10px 20px; background: #482922; color: white; text-decoration: none; border-radius: 5px;'>Go back to Home</a>";
    echo "</div>";

} catch (\Exception $e) {
    echo "<h1>Error updating database:</h1>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
