<?php
// =================================================================
// PAVIITRA TO PAVITRA REBRANDING CORRECTION SCRIPT
// =================================================================

$config = require __DIR__ . '/../config/db.php';

try {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['username'], $config['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    echo "Connected to the database successfully.\n";

    // 1. Update system_settings
    $settings = [
        'company_name' => 'Pavitra Designer Private Limited',
        'brand_name' => 'Pavitra Designer',
        'support_email' => 'wholesale@pavitradesigner.com',
        'office_address' => 'Pavitra Designer Studio & Weavers Association, Varanasi Handloom Cluster, Uttar Pradesh, 221001'
    ];

    foreach ($settings as $key => $val) {
        $stmt = $pdo->prepare("UPDATE system_settings SET setting_value = ? WHERE setting_key = ?");
        $stmt->execute([$val, $key]);
        echo "Updated system setting '{$key}' to '{$val}'.\n";
    }

    // 2. Update users
    $stmt = $pdo->query("SELECT id, name FROM users WHERE name LIKE '%Paviitra%'");
    $users = $stmt->fetchAll();
    foreach ($users as $u) {
        $newName = str_replace('Paviitra', 'Pavitra', $u['name']);
        $upd = $pdo->prepare("UPDATE users SET name = ? WHERE id = ?");
        $upd->execute([$newName, $u['id']]);
        echo "Updated user ID {$u['id']} name from '{$u['name']}' to '{$newName}'.\n";
    }

    // 3. Update seller_profiles
    $stmt = $pdo->query("SELECT id, company_name, brand_name FROM seller_profiles WHERE company_name LIKE '%Paviitra%' OR brand_name LIKE '%Paviitra%'");
    $sellers = $stmt->fetchAll();
    foreach ($sellers as $s) {
        $newCompany = str_replace('Paviitra', 'Pavitra', $s['company_name']);
        $newBrand = str_replace('Paviitra', 'Pavitra', $s['brand_name']);
        $upd = $pdo->prepare("UPDATE seller_profiles SET company_name = ?, brand_name = ? WHERE id = ?");
        $upd->execute([$newCompany, $newBrand, $s['id']]);
        echo "Updated seller ID {$s['id']}: Company = '{$newCompany}', Brand = '{$newBrand}'.\n";
    }

    // 4. Update cms_pages
    $stmt = $pdo->query("SELECT id, title, content, meta_title, meta_description FROM cms_pages");
    $pages = $stmt->fetchAll();
    foreach ($pages as $p) {
        $newTitle = str_replace('Paviitra', 'Pavitra', $p['title']);
        $newContent = str_replace('Paviitra', 'Pavitra', $p['content']);
        $newMetaTitle = str_replace('Paviitra', 'Pavitra', $p['meta_title']);
        $newMetaDesc = str_replace('Paviitra', 'Pavitra', $p['meta_description']);

        $upd = $pdo->prepare("UPDATE cms_pages SET title = ?, content = ?, meta_title = ?, meta_description = ? WHERE id = ?");
        $upd->execute([$newTitle, $newContent, $newMetaTitle, $newMetaDesc, $p['id']]);
        echo "Updated CMS Page ID {$p['id']} '{$p['title']}'.\n";
    }

    echo "Rebranding database updates completed successfully.\n";

} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage() . "\n";
}

// Rebrand files under src/ and core/
function rebrandFile($filePath) {
    $content = file_get_contents($filePath);
    $original = $content;

    // Replace Paviitra with Pavitra (case-insensitive)
    $content = preg_replace('/Paviitra/i', 'Pavitra', $content);

    if ($content !== $original) {
        file_put_contents($filePath, $content);
        echo "Rebranded File: " . $filePath . "\n";
    }
}

function processDirectory($dir) {
    $it = new RecursiveDirectoryIterator($dir);
    foreach (new RecursiveIteratorIterator($it) as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            rebrandFile($file->getPathname());
        }
    }
}

echo "Starting files rebranding...\n";
processDirectory(__DIR__ . '/../core');
processDirectory(__DIR__ . '/../src/Controllers');
processDirectory(__DIR__ . '/../src/Views');
echo "Files rebranding completed.\n";
