<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'location', 'year', 'type', 'category',
        'main_image', 'gallery_images', 'video_url', 'client_name', 'project_area',
        'start_date', 'completion_date', 'is_published', 'is_featured'
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'start_date' => 'date',
        'completion_date' => 'date',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'project_area' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('title') && empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
