<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class News extends Model
{
    protected $fillable = [
        'title',
        'content',
        'banner_image',
        'is_published',
        'is_featured',
        'created_by',
        'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime'
    ];

    // Scope for published news
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->where('published_at', '<=', now());
    }

    // Scope for featured news
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Get formatted published date
    public function getFormattedPublishedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('d M Y') : null;
    }

    // Get excerpt from content
    public function getExcerptAttribute($length = 150)
    {
        return strlen($this->content) > $length 
            ? substr($this->content, 0, $length) . '...' 
            : $this->content;
    }
}
