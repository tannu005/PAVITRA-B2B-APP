<?php
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
    
    echo "Adding reset_token columns to users table...\n";
    $db->exec("ALTER TABLE users ADD COLUMN reset_token VARCHAR(255) NULL AFTER password_hash");
    $db->exec("ALTER TABLE users ADD COLUMN reset_token_expires DATETIME NULL AFTER reset_token");
    echo "Columns added successfully!\n";
    
} catch (\Exception $e) {
    echo "Error or already exists: " . $e->getMessage() . "\n";
}
