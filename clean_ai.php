<?php

function cleanFile($file) {
    $lines = file($file);
    $out = [];
    foreach ($lines as $line) {
        // Strip out purely narrative HTML comments like <!-- Header -->
        if (preg_match('/^\s*<!--\s+[A-Za-z].*?-->\s*$/', $line)) {
            continue;
        }
        // Strip out purely narrative PHP/JS comments like // Check if exists
        if (preg_match('/^\s*\/\/\s+.*$/', $line)) {
            // keep it if it looks like a URL
            if (!str_contains($line, 'http://') && !str_contains($line, 'https://')) {
                continue;
            }
        }
        $out[] = $line;
    }
    file_put_contents($file, implode("", $out));
}

$files = [
    'src/Views/layouts/main.php',
    'src/Controllers/AuthController.php',
    'src/Controllers/RetailerController.php',
    'src/Controllers/SellerController.php',
    'src/Controllers/AdminController.php',
    'core/Application.php',
    'core/Database.php',
    'core/Router.php',
];

foreach ($files as $f) {
    if (file_exists($f)) {
        cleanFile($f);
    }
}
echo "Cleaned\n";
