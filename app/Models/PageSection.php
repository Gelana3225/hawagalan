<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = ['page', 'section', 'key', 'value'];

    public static function get(string $page, string $section, string $key): ?string
    {
        return static::where('page', $page)
            ->where('section', $section)
            ->where('key', $key)
            ->value('value');
    }
}
