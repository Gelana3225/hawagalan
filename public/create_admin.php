<?php
// TEMPORARY - DELETE THIS FILE AFTER USE

// ── Update these with your Plesk DB credentials ──
$host     = 'mysql-db01.remote';
$port     = '31636';
$dbname   = 'hawagalan_laravel';
$username = 'hawagalan_user';
$password = 'gelana_3225'; // <-- update if wrong
// ─────────────────────────────────────────────────

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Create/update admin user
    $email         = 'admin@haawwaagalaan.gov.et';
    $name          = 'Admin';
    $password_hash = password_hash('Admin@1234', PASSWORD_BCRYPT, ['cost' => 12]);

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $existing = $stmt->fetch();

    if ($existing) {
        $pdo->prepare("UPDATE users SET password = ?, name = ? WHERE email = ?")->execute([$password_hash, $name, $email]);
        echo "<p style='color:green;font-family:sans-serif;'>✅ Admin password updated.</p>";
    } else {
        $pdo->prepare("INSERT INTO users (name, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())")->execute([$name, $email, $password_hash]);
        echo "<p style='color:green;font-family:sans-serif;'>✅ Admin user created.</p>";
    }

    echo "<p style='font-family:sans-serif;'>Email: <strong>$email</strong> | Password: <strong>Admin@1234</strong></p>";

    // 2. Fix image paths - strip 'images/' prefix from all image columns
    $fixed = 0;

    $tables = [
        'leaders'             => ['photo'],
        'farming_items'       => ['image'],
        'tourism_attractions' => ['image'],
        'news_posts'          => ['image'],
        'media'               => ['path'],
    ];

    foreach ($tables as $table => $columns) {
        foreach ($columns as $col) {
            $rows = $pdo->query("SELECT id, `$col` FROM `$table` WHERE `$col` LIKE 'images/%'")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $newVal = substr($row[$col], 7);
                $pdo->prepare("UPDATE `$table` SET `$col` = ? WHERE id = ?")->execute([$newVal, $row['id']]);
                $fixed++;
            }
        }
    }

    $rows = $pdo->query("SELECT id, value FROM page_sections WHERE value LIKE 'images/%'")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
        $newVal = substr($row['value'], 7);
        $pdo->prepare("UPDATE page_sections SET value = ? WHERE id = ?")->execute([$newVal, $row['id']]);
        $fixed++;
    }

    echo "<p style='color:green;font-family:sans-serif;'>✅ Fixed $fixed image paths in database.</p>";
    echo "<p style='color:red;font-family:sans-serif;font-weight:bold;'>⚠️ DELETE THIS FILE NOW!</p>";

} catch (Exception $e) {
    echo "<p style='color:red;font-family:sans-serif;'>Error: " . $e->getMessage() . "</p>";
}
