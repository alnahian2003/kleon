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
        'description',
        'status',
        'deadline'
    ];

    protected $casts = [
        'status' => ProjectStatus::class,
        'deadline' => 'datetime',
    ];

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
