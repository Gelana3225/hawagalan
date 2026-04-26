<?php
$host = 'mysql-db01.remote';
$port = '31636';
$dbname = 'hawagalan_laravel';
$username = 'hawagalan_user';
$password = 'gelana_3225';

$pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);

echo "<h3>Leaders photos:</h3><ul>";
foreach ($pdo->query("SELECT name, photo FROM leaders WHERE photo IS NOT NULL LIMIT 5")->fetchAll() as $r) {
    echo "<li>{$r['name']}: <code>{$r['photo']}</code></li>";
}
echo "</ul>";

echo "<h3>Files in httpdocs/images/ (first 5):</h3>";
echo "<p>Check Plesk file manager for actual filenames</p>";
