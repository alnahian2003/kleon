<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, DashboardService $dashboard)
    {
        return Inertia::render('Dashboard', ['data' => $dashboard->getAllData()]);
    }
}
