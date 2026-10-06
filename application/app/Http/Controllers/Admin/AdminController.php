<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        /*
        |--------------------------------------------------------------------------
        | General System Statistics
        |--------------------------------------------------------------------------
        */
        $totalUsers = User::count();

        $totalResumes = Resume::count();

        $activeResumes = Resume::where('status', 'active')->count();

        $inactiveResumes = Resume::where('status', 'inactive')->count();

        $totalViews = (int) Resume::sum('view_count');

        /*
        |--------------------------------------------------------------------------
        | Resume View Analytics
        |--------------------------------------------------------------------------
        */
        $mostViewedResumes = Resume::with('user')
            ->orderByDesc('view_count')
            ->take(5)
            ->get();

        $recentlyViewedResumes = Resume::with('user')
            ->whereNotNull('last_viewed_at')
            ->orderByDesc('last_viewed_at')
            ->take(5)
            ->get();

        $allResumes = Resume::with('user')
            ->latest()
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalResumes',
            'activeResumes',
            'inactiveResumes',
            'totalViews',
            'mostViewedResumes',
            'recentlyViewedResumes',
            'allResumes'
        ));
    }
}