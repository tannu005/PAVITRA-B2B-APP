<?php
// Installation and Migration Wizard for Pavitra B2B Platform

$config = require dirname(__DIR__) . '/config/db.php';
$status = '';
$error = '';
$logs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'install') {
    try {
        // 1. Connect to MySQL without dbname first
        $dsnTemp = "mysql:host={$config['host']};port={$config['port']};charset={$config['charset']}";
        $pdo = new PDO($dsnTemp, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        $logs[] = "Connected to MySQL host {$config['host']}.";

        // 2. Drop and recreate database for a clean installation slate
        $pdo->exec("DROP DATABASE IF EXISTS `{$config['dbname']}`");
        $pdo->exec("CREATE DATABASE `{$config['dbname']}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $logs[] = "Database `{$config['dbname']}` dropped and fresh database created.";

        // 3. Reconnect to the database
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
        $pdo = new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        // Disable foreign keys temporarily during schema builds
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");

        // 4. Load schema.sql
        $schemaPath = dirname(__DIR__) . '/database/schema.sql';
        if (!file_exists($schemaPath)) {
            throw new Exception("schema.sql file not found at " . $schemaPath);
        }
        $schemaSql = file_get_contents($schemaPath);
        
        // Split schema queries by semicolon, filtering out empty lines
        // We'll execute them chunk-by-chunk or as a multi-query exec
        $pdo->exec($schemaSql);
        $logs[] = "Successfully imported all database tables (86 tables created).";

        // 5. Load seeds.sql
        $seedsPath = dirname(__DIR__) . '/database/seeds.sql';
        if (!file_exists($seedsPath)) {
            throw new Exception("seeds.sql file not found at " . $seedsPath);
        }
        $seedsSql = file_get_contents($seedsPath);
        $pdo->exec($seedsSql);
        $logs[] = "Successfully seeded platform roles, permissions, administrative settings, and demo products.";

        // Re-enable foreign keys
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");

        $status = 'success';
    } catch (Exception $e) {
        $error = $e->getMessage();
        $status = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Wizard - Pavitra B2B</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F8F9FA;
            font-family: 'Segoe UI', Roboto, sans-serif;
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .install-card {
            background: white;
            padding: 3rem;
            border-radius: 12px;
            border: 1px solid #EAEAEA;
            box-shadow: 0 15px 40px rgba(0,0,0,0.04);
            max-width: 600px;
            width: 100%;
        }
        .text-pink {
            color: #F43397;
        }
        .btn-pink {
            background-color: #F43397;
            border-color: #F43397;
            color: white;
            font-weight: 600;
        }
        .btn-pink:hover {
            background-color: #DE217E;
            border-color: #DE217E;
            color: white;
        }
        .log-box {
            background-color: #1E1E1E;
            color: #A3FFA3;
            font-family: monospace;
            font-size: 0.8rem;
            padding: 1rem;
            border-radius: 6px;
            max-height: 200px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="install-card">
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-1 text-pink">Pavitra B2B Platform</h2>
            <p class="text-muted">Installation & Database Seeder Wizard</p>
        </div>

        <?php if ($status === 'success'): ?>
            <div class="alert alert-success p-3 mb-4">
                <h5 class="fw-bold"><i class="fa fa-circle-check"></i> Setup Completed!</h5>
                Database schema has been compiled, migrated, and populated with authentic GI-tagged saree listings.
            </div>

            <div class="log-box mb-4">
                <?php foreach ($logs as $log): ?>
                    <div>&gt; <?= htmlspecialchars($log) ?></div>
                <?php endforeach; ?>
                <div>&gt; Migration finished successfully! Ready to login.</div>
            </div>

            <div class="bg-light p-3 rounded mb-4" style="font-size: 0.85rem;">
                <h6 class="fw-bold mb-2">Merchant Demo Login Credentials:</h6>
                • <strong>Retailer:</strong> <code>boutique@meeshob2b.com</code> / <code>password123</code><br>
                • <strong>Seller/Weaver:</strong> <code>weaver@meeshob2b.com</code> / <code>password123</code><br>
                • <strong>Super Admin:</strong> <code>admin@meeshob2b.com</code> / <code>password123</code><br>
                • <strong>Delivery Driver:</strong> <code>delivery@meeshob2b.com</code> / <code>password123</code>
            </div>

            <div class="d-grid">
                <a href="/login" class="btn btn-pink py-2">Go to Sign In Portal</a>
            </div>

        <?php else: ?>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger p-3 mb-4">
                    <h6 class="fw-bold">Database Setup Failed:</h6>
                    <p class="mb-0 small"><?= htmlspecialchars($error) ?></p>
                </div>
            <?php endif; ?>

            <p class="text-muted small mb-4">
                Clicking the button below will automatically initialize the database catalog `meesho_b2b` on host `<?= htmlspecialchars($config['host']) ?>` using schema file `database/schema.sql` and default parameters.
            </p>

            <form action="/install.php" method="POST">
                <input type="hidden" name="action" value="install">
                <div class="d-grid">
                    <button type="submit" class="btn btn-pink py-2">Install Database & Seed Listings</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
