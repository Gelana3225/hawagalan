<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TourismAttraction extends Model
{
    protected $fillable = ['name', 'description', 'image', 'category', 'features', 'sort_order', 'is_visible'];

    protected $casts = [
        'features'   => 'array',
        'is_visible' => 'boolean',
    ];

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
