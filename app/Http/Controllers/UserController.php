<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::paginate()
        ]);
    }

    public function clients()
    {
        $clients = User::select(['name', 'company_name', 'address', 'is_active'])
            ->where('is_admin', false)
            ->has('projects')
            ->withCount('projects')
            ->latest()
            ->paginate();

        return Inertia::render('Clients/Index', [
            'clients' => $clients
        ]);
    }
}
