<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Accessor for full banner image URL with graceful fallback.
     */
    public function getBannerImageUrlAttribute(): string
    {
        if (!$this->banner_image) {
            return asset('images/logo-unand.png');
        }

        if (filter_var($this->banner_image, FILTER_VALIDATE_URL)) {
            return $this->banner_image;
        }

        $relativePath = ltrim($this->banner_image, '/');

        if (Storage::disk('public')->exists($relativePath)) {
            $hasSymlink = $this->ensurePublicStorageAccessible();

            if (!$hasSymlink) {
                $this->mirrorBannerToPublicDirectory($relativePath);
            }

            return asset('storage/' . $relativePath);
        }

        if (file_exists(public_path($relativePath))) {
            return asset($relativePath);
        }

        return asset('images/logo-unand.png');
    }

    /**
     * Ensure public/storage link exists or directory fallback.
     */
    protected function ensurePublicStorageAccessible(): bool
    {
        $linkPath = public_path('storage');
        $targetPath = storage_path('app/public');

        if (is_link($linkPath) || is_dir($linkPath)) {
            return is_link($linkPath);
        }

        try {
            symlink($targetPath, $linkPath);
            return true;
        } catch (\Throwable $e) {
            Log::warning('Gagal membuat symbolic link storage -> public dari accessor.', [
                'error' => $e->getMessage(),
            ]);

            if (!is_dir($linkPath)) {
                mkdir($linkPath, 0755, true);
            }

            return false;
        }
    }

    /**
     * Copy banner file into public/storage if symlink not available.
     */
    protected function mirrorBannerToPublicDirectory(string $relativePath): void
    {
        $source = storage_path('app/public/' . $relativePath);
        $destination = public_path('storage/' . $relativePath);

        if (!is_file($source)) {
            return;
        }

        $destinationDir = dirname($destination);
        if (!is_dir($destinationDir)) {
            mkdir($destinationDir, 0755, true);
        }

        try {
            copy($source, $destination);
        } catch (\Throwable $e) {
            Log::warning('Gagal menyalin banner ke direktori publik melalui accessor.', [
                'error' => $e->getMessage(),
                'relative_path' => $relativePath,
            ]);
        }
    }
}
