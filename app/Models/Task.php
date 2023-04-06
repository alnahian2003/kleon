<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'title',
        'slug',
        'comment',
    ];

    /**
     * Auto generate a slug for the task using title before creating or updating
     * so that we don't need to manually generate it from controller.
     */
    protected static function booted(): void
    {
        static::creating(function (Task $task) {
            return $task->slug = $task->generateSlug($task->title);
        });

        static::updating(function (Task $task) {
            return $task->slug = $task->generateSlug($task->title);
        });
    }

    protected function generateSlug($title)
    {
        $slug = str()->slug($title);
        $query = Task::where('slug', $slug);
        $count = $query->count();

        if ($count > 0) {
            // Generate a unique slug
            $i = 1;
            while (Task::where('slug', $slug . '-' . $i)->count() > 0) {
                $i++;
            }
            $slug = $slug . '-' . $i;
        }

        return $slug;
    }

    /**
     * Change the route model binding key name for the 'slug' column.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /* Accessors & Mutators */

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('m/d/Y'),
        );
    }

    public function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('m/d/Y'),
        );
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

    /* Query Scopes */
    public function scopeUserTasks(Builder $taskQuery)
    {
        return $taskQuery->when(!auth()->user()->is_admin, fn ($query) => $query->where('user_id', auth()->user()->id));
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        return $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('comment', 'like', "%$search%");
        });
    }
}
