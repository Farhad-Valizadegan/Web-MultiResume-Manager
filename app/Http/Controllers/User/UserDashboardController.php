<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    public function dashboard(): View
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | User Resume List
        |--------------------------------------------------------------------------
        */
        $resumes = $user->resumes()
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */
        $totalResumes = $user->resumes()->count();

        $activeResumes = $user->resumes()
            ->where('status', 'active')
            ->count();

        $inactiveResumes = $user->resumes()
            ->where('status', 'inactive')
            ->count();

        $totalViews = (int) $user->resumes()
            ->sum('view_count');

        /*
        |--------------------------------------------------------------------------
        | Resume Analytics
        |--------------------------------------------------------------------------
        */
        $mostViewedResumes = $user->resumes()
            ->orderByDesc('view_count')
            ->take(5)
            ->get();

        $recentlyViewedResumes = $user->resumes()
            ->whereNotNull('last_viewed_at')
            ->orderByDesc('last_viewed_at')
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'resumes',
            'totalResumes',
            'activeResumes',
            'inactiveResumes',
            'totalViews',
            'mostViewedResumes',
            'recentlyViewedResumes'
        ));
    }
}