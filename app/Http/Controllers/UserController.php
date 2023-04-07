<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::select(['name', 'email'])
                ->filter(request()->only('search'))
                ->paginate(),
        ]);
    }

    public function clients()
    {
        $clients = User::clients()
            ->select(['name', 'company_name', 'address', 'is_active'])
            ->filter(request()->only('search'))
            ->withCount('projects')
            ->latest()
            ->paginate();

        return Inertia::render('Clients/Index', [
            'clients' => $clients,
        ]);
    }
}
