<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resume;

class ResumeController extends Controller
{
    public function index()
    {
        $resumes = Resume::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.resumes.index', compact('resumes'));
    }

    public function show(Resume $resume)
    {
        $resume->load([
            'user',
            'skills',
            'educations',
            'experiences',
            'projects',
        ]);

        return view('admin.resumes.show', compact('resume'));
    }

    public function destroy(Resume $resume)
    {
        app(\App\Services\ResumeFiles::class)->transaction(fn () => $resume->delete());

        return redirect()
            ->route('admin.resumes.index')
            ->with('success', 'Resume deleted successfully.');
    }
}