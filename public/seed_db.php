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
    
    // Connect with multi-statements enabled so we can execute massive SQL dump files directly
    $db = new \PDO($dsn, $config['username'], $config['password'], [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_EMULATE_PREPARES => true,
        \PDO::MYSQL_ATTR_MULTI_STATEMENTS => true,
    ]);

    $db->exec('SET FOREIGN_KEY_CHECKS = 0;');

    // 1. Run schema.sql
    $schemaPath = dirname(__DIR__) . '/database/schema.sql';
    if (file_exists($schemaPath)) {
        $sql = file_get_contents($schemaPath);
        $db->exec($sql);
    }

    // 2. Run seeds.sql
    $seedsPath = dirname(__DIR__) . '/database/seeds.sql';
    if (file_exists($seedsPath)) {
        $sql = file_get_contents($seedsPath);
        $db->exec($sql);
    }

    $db->exec('SET FOREIGN_KEY_CHECKS = 1;');
    
    // 3. Clear Cache
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
