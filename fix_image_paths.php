<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

error_reporting(E_ALL & ~E_DEPRECATED);

use Illuminate\Support\Facades\DB;

// Strip 'images/' prefix from all image columns so DB stores just 'xxx.jpg'
// Then blade uses asset('images/'.$x) correctly

$tables = [
    'leaders'             => ['photo'],
    'farming_items'       => ['image'],
    'tourism_attractions' => ['image'],
    'news_posts'          => ['image'],
    'services'            => [],
    'media'               => ['path'],
];

foreach ($tables as $table => $columns) {
    foreach ($columns as $col) {
        $rows = DB::table($table)->whereNotNull($col)->get(['id', $col]);
        foreach ($rows as $row) {
            $val = $row->$col;
            if (str_starts_with($val, 'images/')) {
                $newVal = substr($val, 7); // strip 'images/'
                DB::table($table)->where('id', $row->id)->update([$col => $newVal]);
                echo "Fixed $table #$row->id: $val → $newVal\n";
            }
        }
    }
}

// Fix page_sections values that are image paths
$rows = DB::table('page_sections')
    ->where('value', 'like', 'images/%')
    ->get(['id', 'value']);
foreach ($rows as $row) {
    $newVal = substr($row->value, 7);
    DB::table('page_sections')->where('id', $row->id)->update(['value' => $newVal]);
    echo "Fixed page_sections #$row->id: $row->value → $newVal\n";
}

echo "\nDone! All image paths stripped of 'images/' prefix.\n";
