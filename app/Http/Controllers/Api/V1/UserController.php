<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::filter(request()->only('search'))
            ->paginate();

        return UserResource::collection($users);
    }

    /**
     * Display a listing of the clients.
     */
    public function clients()
    {
        $clients = User::select(['name', 'company_name', 'address', 'is_active'])
            ->filter(request()->only('search'))
            ->where('is_admin', false)
            ->has('projects')
            ->withCount('projects')
            ->latest()
            ->paginate();

        return ClientResource::collection($clients);
    }
}
