<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $tasks = $request->user()->tasks();

        return view('dashboard', [
            'totalTasks' => (clone $tasks)->count(),
            'pendingTasks' => (clone $tasks)->where('status', 'pending')->count(),
            'completedTasks' => (clone $tasks)->where('status', 'completed')->count(),
            'recentTasks' => (clone $tasks)->latest()->limit(5)->get(),
        ]);
    }
}
