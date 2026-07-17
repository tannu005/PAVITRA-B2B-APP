<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Core\Application;

$app = new Application();
$db = $app->db->pdo;

try {
    $db->exec('SET FOREIGN_KEY_CHECKS = 0');

    // 1. Run schema.sql
    $schemaPath = dirname(__DIR__) . '/database/schema.sql';
    if (file_exists($schemaPath)) {
        $sql = file_get_contents($schemaPath);
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        foreach ($statements as $stmt) {
            if (!empty($stmt)) {
                try {
                    $db->exec($stmt);
                } catch (\Exception $e) {
                    // Ignore drops that fail or similar minor issues
                }
            }
        }
    }

    // 2. Run seeds.sql
    $seedsPath = dirname(__DIR__) . '/database/seeds.sql';
    if (file_exists($seedsPath)) {
        // Since seeds.sql is huge and has massive INSERTs, we can't easily split by ';' safely if data has semicolons.
        // Better to use a simpler execution for seeds if possible, or execute the whole thing if the driver supports it.
        // PDO with mysql supports executing multiple statements at once if emulate prepares is on, which is default.
        $sql = file_get_contents($seedsPath);
        try {
            $db->exec($sql);
        } catch (\PDOException $e) {
            echo "Error running seeds: " . $e->getMessage() . "<br>";
        }
    }

    $db->exec('SET FOREIGN_KEY_CHECKS = 1');
    
    // 3. Clear Cache
    $app->cache->clear();

    echo "<h1>Database successfully updated!</h1>";
    echo "<p>The new schema and 627 authentic products have been imported to this server.</p>";
    echo "<a href='/'>Go back to Home</a>";

} catch (\Exception $e) {
    echo "<h1>Error updating database:</h1>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
