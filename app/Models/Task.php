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
        'comment'
    ];

    // A task must belong to a user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A task can belong to a project.
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
