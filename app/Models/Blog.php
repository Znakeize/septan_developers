<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'slug', 'category', 'excerpt', 'content',
        'featured_image', 'tags', 'published_date', 'reading_time', 'views', 'is_published'
    ];

    protected $casts = [
        'tags' => 'array',
        'published_date' => 'date',
        'is_published' => 'boolean',
        'reading_time' => 'integer',
        'views' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
            if (empty($blog->user_id) && auth()->check()) {
                $blog->user_id = auth()->id();
            }
            // Calculate reading time (average 200 words per minute)
            if (empty($blog->reading_time)) {
                $wordCount = str_word_count(strip_tags($blog->content));
                $blog->reading_time = max(1, (int) ceil($wordCount / 200));
            }
        });

        static::updating(function ($blog) {
            if ($blog->isDirty('title') && empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
            // Recalculate reading time if content changed
            if ($blog->isDirty('content')) {
                $wordCount = str_word_count(strip_tags($blog->content));
                $blog->reading_time = max(1, (int) ceil($wordCount / 200));
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}
