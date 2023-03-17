<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'status',
        'deadline'
    ];

    protected $casts = [
        'status' => ProjectStatus::class,
        'deadline' => 'datetime',
    ];

    /**
     * Auto generate a slug for the project using title before creating or updating
     * so that we don't need to manually generate it from controller.
     */
    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            return $project->slug = str($project->title)->slug();
        });

        static::updating(function (Project $project) {
            return $project->slug = str($project->title)->slug();
        });
    }

    // Change the route model binding key name for the 'slug' column.
    public function getRouteKeyName(): string
    {
        return "slug";
    }

    // A project must belong to a client.
    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // A Project can have many tasks.
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
