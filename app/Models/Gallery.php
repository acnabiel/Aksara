<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'google_drive_url',
        'source',
        'type',
        'category',
        'album',
        'thumbnail_path',
        'file_size',
        'user_id',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Get the user that uploaded this gallery item.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if this item is from Google Drive.
     */
    public function isGoogleDrive(): bool
    {
        return $this->source === 'gdrive' && !empty($this->google_drive_url);
    }

    /**
     * Extract Google Drive file ID from various URL formats.
     */
    public static function extractGoogleDriveFileId(string $url): ?string
    {
        // Format: https://drive.google.com/file/d/FILE_ID/view
        if (preg_match('/\/file\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $matches[1];
        }
        // Format: https://drive.google.com/open?id=FILE_ID
        if (preg_match('/[?&]id=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $matches[1];
        }
        // Format: https://drive.google.com/uc?id=FILE_ID
        if (preg_match('/uc\?.*id=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }

    /**
     * Get the direct/embeddable URL for Google Drive files.
     */
    public function getGoogleDriveDirectUrl(): ?string
    {
        if (!$this->google_drive_url) return null;
        
        $fileId = self::extractGoogleDriveFileId($this->google_drive_url);
        if (!$fileId) return null;

        if ($this->isPhoto()) {
            // Direct image preview
            return "https://drive.google.com/thumbnail?id={$fileId}&sz=w1200";
        } else {
            // Video preview/embed
            return "https://drive.google.com/file/d/{$fileId}/preview";
        }
    }

    /**
     * Get Google Drive thumbnail URL (for video thumbnails).
     */
    public function getGoogleDriveThumbnailUrl(): ?string
    {
        if (!$this->google_drive_url) return null;
        
        $fileId = self::extractGoogleDriveFileId($this->google_drive_url);
        if (!$fileId) return null;

        return "https://drive.google.com/thumbnail?id={$fileId}&sz=w600";
    }

    /**
     * Get the display URL for this gallery item (works for both upload and gdrive).
     */
    public function getDisplayUrl(): string
    {
        if ($this->isGoogleDrive()) {
            return $this->getGoogleDriveDirectUrl() ?? '';
        }
        
        return $this->file_path ? asset('storage/' . $this->file_path) : '';
    }

    /**
     * Get the file URL.
     */
    public function getFileUrlAttribute(): string
    {
        if ($this->isGoogleDrive()) {
            return $this->getGoogleDriveDirectUrl() ?? '';
        }
        return $this->file_path ? Storage::url($this->file_path) : '';
    }

    /**
     * Get the thumbnail URL.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if ($this->isGoogleDrive()) {
            return $this->getGoogleDriveThumbnailUrl();
        }
        return $this->thumbnail_path ? Storage::url($this->thumbnail_path) : null;
    }

    /**
     * Get formatted file size.
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->file_size;
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' B';
    }

    /**
     * Scope: filter by type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope: filter by category.
     */
    public function scopeOfCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Check if this is a photo.
     */
    public function isPhoto(): bool
    {
        return $this->type === 'photo';
    }

    /**
     * Check if this is a video.
     */
    public function isVideo(): bool
    {
        return $this->type === 'video';
    }
}
