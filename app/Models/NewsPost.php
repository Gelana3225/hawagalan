<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NewsPost extends Model
{
    protected $fillable = ['title', 'body', 'image', 'images', 'is_published', 'published_at'];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'images'       => 'array',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now());
    }

    // All photos: cover image + extra images combined
    public function allImages(): array
    {
        $all = [];
        if ($this->image) $all[] = $this->image;
        if ($this->images) $all = array_merge($all, $this->images);
        return $all;
    }
}
