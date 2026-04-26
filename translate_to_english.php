<?php

/**
 * Auto-translate Afan Oromo content to English using MyMemory API
 * Run: php translate_to_english.php
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

// Suppress deprecation warnings
error_reporting(E_ALL & ~E_DEPRECATED);

$translated = 0;
$failed = 0;

function translate(string $text): ?string
{
    if (empty(trim($text))) return null;

    // Truncate to 500 chars (MyMemory free limit per request)
    $chunks = mb_str_split($text, 450);
    $result = [];

    foreach ($chunks as $chunk) {
        $url = 'https://api.mymemory.translated.net/get?q=' . urlencode($chunk) . '&langpair=om|en';

        $ctx = stream_context_create(['http' => ['timeout' => 10]]);
        $response = @file_get_contents($url, false, $ctx);

        if (!$response) {
            echo "  [!] HTTP request failed\n";
            return null;
        }

        $data = json_decode($response, true);

        if (isset($data['responseStatus']) && $data['responseStatus'] == 200) {
            $result[] = $data['responseData']['translatedText'];
        } else {
            echo "  [!] API error: " . ($data['responseDetails'] ?? 'unknown') . "\n";
            return null;
        }

        // Rate limit: 1 request/second for free tier
        usleep(1100000);
    }

    return implode(' ', $result);
}

function translateAndUpdate(string $table, int $id, array $fields): void
{
    global $translated, $failed;

    $row = DB::table($table)->find($id);
    if (!$row) return;

    $updates = [];

    foreach ($fields as $src => $dest) {
        $value = $row->$src ?? null;
        if (empty($value)) continue;

        // Skip if already translated
        if (!empty($row->$dest)) {
            echo "  [skip] $table #$id $dest already has content\n";
            continue;
        }

        echo "  Translating $table #$id [$src]...\n";
        $translated_text = translate($value);

        if ($translated_text) {
            $updates[$dest] = $translated_text;
            echo "  ✓ Done\n";
            $translated++;
        } else {
            echo "  ✗ Failed\n";
            $failed++;
        }
    }

    if (!empty($updates)) {
        DB::table($table)->where('id', $id)->update($updates);
    }
}

// ── Leaders ──────────────────────────────────────────────
echo "\n=== Leaders ===\n";
$leaders = DB::table('leaders')->get();
foreach ($leaders as $leader) {
    echo "Leader #{$leader->id}: {$leader->name}\n";
    translateAndUpdate('leaders', $leader->id, [
        'name'        => 'name_en',
        'title'       => 'title_en',
        'description' => 'description_en',
    ]);
}

// ── Services ─────────────────────────────────────────────
echo "\n=== Services ===\n";
$services = DB::table('services')->get();
foreach ($services as $service) {
    echo "Service #{$service->id}: {$service->name}\n";
    translateAndUpdate('services', $service->id, [
        'name'        => 'name_en',
        'description' => 'description_en',
    ]);
}

// ── Farming Items ─────────────────────────────────────────
echo "\n=== Farming Items ===\n";
$items = DB::table('farming_items')->get();
foreach ($items as $item) {
    echo "FarmingItem #{$item->id}: {$item->label}\n";
    translateAndUpdate('farming_items', $item->id, [
        'label'    => 'label_en',
        'alt_text' => 'alt_text_en',
    ]);
}

// ── Tourism Attractions ───────────────────────────────────
echo "\n=== Tourism Attractions ===\n";
$attractions = DB::table('tourism_attractions')->get();
foreach ($attractions as $attraction) {
    echo "Tourism #{$attraction->id}: {$attraction->name}\n";
    translateAndUpdate('tourism_attractions', $attraction->id, [
        'name'        => 'name_en',
        'description' => 'description_en',
        'category'    => 'category_en',
    ]);
}

// ── News Posts ────────────────────────────────────────────
echo "\n=== News Posts ===\n";
$posts = DB::table('news_posts')->get();
foreach ($posts as $post) {
    echo "News #{$post->id}: {$post->title}\n";
    translateAndUpdate('news_posts', $post->id, [
        'title' => 'title_en',
        'body'  => 'body_en',
    ]);
}

// ── Page Sections ─────────────────────────────────────────
echo "\n=== Page Sections ===\n";
$sections = DB::table('page_sections')->where('language', 'om')->get();
foreach ($sections as $section) {
    // Skip image paths and empty values
    if (empty($section->value)) continue;
    if (preg_match('/\.(jpg|jpeg|png|webp|gif|svg)$/i', $section->value)) continue;

    // Check if English version already exists
    $exists = DB::table('page_sections')
        ->where('page', $section->page)
        ->where('section', $section->section)
        ->where('key', $section->key)
        ->where('language', 'en')
        ->exists();

    if ($exists) {
        echo "  [skip] {$section->page}/{$section->section}/{$section->key} already translated\n";
        continue;
    }

    echo "  Translating page_sections: {$section->page}/{$section->section}/{$section->key}...\n";
    $translated_text = translate($section->value);

    if ($translated_text) {
        DB::table('page_sections')->insert([
            'page'       => $section->page,
            'section'    => $section->section,
            'key'        => $section->key,
            'value'      => $translated_text,
            'language'   => 'en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        echo "  ✓ Done\n";
        $translated++;
    } else {
        echo "  ✗ Failed\n";
        $failed++;
    }
}

echo "\n=============================\n";
echo "✓ Translated: $translated\n";
echo "✗ Failed:     $failed\n";
echo "=============================\n";
