<?php
// =================================================================
// PAVITRA TO PAVIITRA DESIGNER DATABASE REBRANDING SCRIPT
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
        'company_name' => 'Paviitra Designer Private Limited',
        'brand_name' => 'Paviitra Designer',
        'support_email' => 'wholesale@paviitradesigner.com',
        'office_address' => 'Paviitra Designer Studio & Weavers Association, Varanasi Handloom Cluster, Uttar Pradesh, 221001'
    ];

    foreach ($settings as $key => $val) {
        $stmt = $pdo->prepare("UPDATE system_settings SET setting_value = ? WHERE setting_key = ?");
        $stmt->execute([$val, $key]);
        echo "Updated system setting '{$key}' to '{$val}'.\n";
    }

    // 2. Update users
    $stmt = $pdo->query("SELECT id, name FROM users WHERE name LIKE '%Pavitra%'");
    $users = $stmt->fetchAll();
    foreach ($users as $u) {
        $newName = str_replace('Pavitra', 'Paviitra', $u['name']);
        $upd = $pdo->prepare("UPDATE users SET name = ? WHERE id = ?");
        $upd->execute([$newName, $u['id']]);
        echo "Updated user ID {$u['id']} name from '{$u['name']}' to '{$newName}'.\n";
    }

    // 3. Update seller_profiles
    $stmt = $pdo->query("SELECT id, company_name, brand_name FROM seller_profiles WHERE company_name LIKE '%Pavitra%' OR brand_name LIKE '%Pavitra%'");
    $sellers = $stmt->fetchAll();
    foreach ($sellers as $s) {
        $newCompany = str_replace('Pavitra', 'Paviitra', $s['company_name']);
        $newBrand = str_replace('Pavitra', 'Paviitra', $s['brand_name']);
        $upd = $pdo->prepare("UPDATE seller_profiles SET company_name = ?, brand_name = ? WHERE id = ?");
        $upd->execute([$newCompany, $newBrand, $s['id']]);
        echo "Updated seller ID {$s['id']}: Company = '{$newCompany}', Brand = '{$newBrand}'.\n";
    }

    // 4. Update cms_pages
    $stmt = $pdo->query("SELECT id, title, content, meta_title, meta_description FROM cms_pages");
    $pages = $stmt->fetchAll();
    foreach ($pages as $p) {
        $newTitle = str_replace(['Pavitra B2B', 'Pavitra'], ['Paviitra Designer', 'Paviitra Designer'], $p['title']);
        $newContent = str_replace(['Pavitra B2B', 'Pavitra'], ['Paviitra Designer', 'Paviitra Designer'], $p['content']);
        $newMetaTitle = str_replace(['Pavitra B2B', 'Pavitra'], ['Paviitra Designer', 'Paviitra Designer'], $p['meta_title']);
        $newMetaDesc = str_replace(['Pavitra B2B', 'Pavitra'], ['Paviitra Designer', 'Paviitra Designer'], $p['meta_description']);

        $upd = $pdo->prepare("UPDATE cms_pages SET title = ?, content = ?, meta_title = ?, meta_description = ? WHERE id = ?");
        $upd->execute([$newTitle, $newContent, $newMetaTitle, $newMetaDesc, $p['id']]);
        echo "Updated CMS Page ID {$p['id']} '{$p['title']}'.\n";
    }

    echo "Rebranding database updates completed successfully.\n";

} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage() . "\n";
}
