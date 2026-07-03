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
            return;
        }
    }
});

$config = [
    'db' => [
        'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=meesho_b2b',
        'user' => 'root',
        'password' => ''
    ]
];

try {
    $db = new \PDO($config['db']['dsn'], $config['db']['user'], $config['db']['password']);
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
    echo "--- USERS TABLE COLUMNS ---\n";
    $stmt = $db->query("DESCRIBE users");
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        echo "{$row['Field']} - {$row['Type']}\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
