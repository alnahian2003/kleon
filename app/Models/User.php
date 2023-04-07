<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'address',
        'company_name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'is_active' => 'boolean',
    ];

    /* Query Scopes */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    public function scopeAdmin(Builder $query): Builder
    {
        return $query->where('is_admin', true);
    }

    public function scopeClients(Builder $query): Builder
    {
        return $query->where('is_admin', false)
            ->has('projects');
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        return $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('address', 'like', "%$search%")
                ->orWhere('company', 'like', "%$search%");
        });
    }

    /* Eloquent Relationships */

    // A client can have many projects
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // A user can have many tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
