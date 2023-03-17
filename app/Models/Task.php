<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'project_id',
        'title',
        'slug',
        'comment'
    ];

    /**
     * Auto generate a slug for the task using title before creating or updating
     * so that we don't need to manually generate it from controller.
     */
    protected static function booted(): void
    {
        static::creating(function (Task $task) {
            return $task->slug = str($task->title)->slug();
        });

        static::updating(function (Task $task) {
            return $task->slug = str($task->title)->slug();
        });
    }

    /**
     * Change the route model binding key name for the 'slug' column.
     */
    public function getRouteKeyName(): string
    {
        return "slug";
    }

    /** 
     * A task must belong to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A task can belong to a project.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
