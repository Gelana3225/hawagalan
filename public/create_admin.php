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

    // 2. Clear all image paths from DB so you can re-upload fresh
    $cleared = 0;

    $tables = [
        'leaders'             => ['photo'],
        'farming_items'       => ['image'],
        'tourism_attractions' => ['image'],
        'news_posts'          => ['image'],
        'media'               => ['path'],
    ];

    foreach ($tables as $table => $columns) {
        foreach ($columns as $col) {
            $count = $pdo->exec("UPDATE `$table` SET `$col` = NULL");
            $cleared += $count;
        }
    }

    // Clear image values from page_sections (keep text values)
    $imageExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];
    $rows = $pdo->query("SELECT id, value FROM page_sections WHERE value IS NOT NULL")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
        $ext = strtolower(pathinfo($row['value'], PATHINFO_EXTENSION));
        if (in_array($ext, $imageExtensions)) {
            $pdo->prepare("UPDATE page_sections SET value = NULL WHERE id = ?")->execute([$row['id']]);
            $cleared++;
        }
    }

    echo "<p style='color:green;font-family:sans-serif;'>✅ Cleared $cleared image paths from database. Now re-upload all images from the admin panel.</p>";
    echo "<p style='color:red;font-family:sans-serif;font-weight:bold;'>⚠️ DELETE THIS FILE NOW!</p>";

} catch (Exception $e) {
    echo "<p style='color:red;font-family:sans-serif;'>Error: " . $e->getMessage() . "</p>";
}
