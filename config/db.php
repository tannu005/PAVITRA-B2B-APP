<?php
$envPath = dirname(__DIR__) . '/.env';
if (file_exists($envPath)) {
    $envVars = parse_ini_file($envPath);
    if ($envVars) {
        foreach ($envVars as $key => $value) {
            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }
}
$dbHost = $_ENV['DB_HOST'] ?? null;
$mysqlUrl = $_ENV['MYSQL_URL'] ?? $_ENV['DATABASE_URL'] ?? (strpos($dbHost, 'mysql://') === 0 ? $dbHost : null);
if ($mysqlUrl) {
    $url = parse_url($mysqlUrl);
    return [
        'host' => $url['host'],
        'port' => $url['port'] ?? '3306',
        'dbname' => ltrim($url['path'], '/'),
        'username' => $url['user'],
        'password' => $url['pass'] ?? '',
        'charset' => 'utf8mb4'
    ];
}
return [
    'host' => $dbHost ?? '127.0.0.1',
    'port' => $_ENV['DB_PORT'] ?? '3306',
    'dbname' => $_ENV['DB_NAME'] ?? 'pavitra_b2b',
    'username' => $_ENV['DB_USER'] ?? 'root',
    'password' => $_ENV['DB_PASS'] ?? '',
    'charset' => $_ENV['DB_CHARSET'] ?? 'utf8mb4'
];
