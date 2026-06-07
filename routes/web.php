<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ResumeController as AdminResumeController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\ResumeController;
use App\Http\Controllers\PublicResumeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Home Route
|--------------------------------------------------------------------------
| If visitor is not logged in: go to login page.
| If user is logged in: redirect based on role.
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');
});

/*
|--------------------------------------------------------------------------
| Safe Logout Redirect
|--------------------------------------------------------------------------
| Laravel logout uses POST. This prevents an error if /logout is opened
| directly in the browser by mistake.
|--------------------------------------------------------------------------
*/
Route::get('/logout', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('admin.dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');

        Route::get('/resumes', [AdminResumeController::class, 'index'])->name('resumes.index');
        Route::get('/resumes/{resume}', [AdminResumeController::class, 'show'])->name('resumes.show');
        Route::delete('/resumes/{resume}', [AdminResumeController::class, 'destroy'])->name('resumes.destroy');
    });

/*
|--------------------------------------------------------------------------
| User Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/user/dashboard', [UserDashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'user'])
    ->name('user.dashboard');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/resumes', [ResumeController::class, 'index'])->name('resumes.index');
        Route::get('/resumes/create', [ResumeController::class, 'create'])->name('resumes.create');
        Route::post('/resumes', [ResumeController::class, 'store'])->name('resumes.store');
        Route::get('/resumes/{resume}/edit', [ResumeController::class, 'edit'])->name('resumes.edit');
        Route::put('/resumes/{resume}', [ResumeController::class, 'update'])->name('resumes.update');
        Route::delete('/resumes/{resume}', [ResumeController::class, 'destroy'])->name('resumes.destroy');

        Route::get('/resumes/{resume}/password', [ResumeController::class, 'password'])->name('resumes.password');
        Route::put('/resumes/{resume}/password', [ResumeController::class, 'updatePassword'])->name('resumes.updatePassword');
    });

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Public Resume Routes
|--------------------------------------------------------------------------
| These routes are used by employers / visitors.
| They do not need login.
|--------------------------------------------------------------------------
*/
Route::get('/resume/{publicLink}', [PublicResumeController::class, 'showPasswordForm'])
    ->name('public.resume.password');

Route::post('/resume/{publicLink}', [PublicResumeController::class, 'verifyPassword'])
    ->name('public.resume.verify');

Route::get('/resume/{publicLink}/view', [PublicResumeController::class, 'view'])
    ->name('public.resume.view');

Route::get('/resume/{publicLink}/download-generated-pdf', [PublicResumeController::class, 'downloadGeneratedPdf'])
    ->name('public.resume.download-generated-pdf');

Route::get('/resume/{publicLink}/download-uploaded-pdf', [PublicResumeController::class, 'downloadUploadedPdf'])
    ->name('public.resume.download-uploaded-pdf');

require __DIR__ . '/auth.php';