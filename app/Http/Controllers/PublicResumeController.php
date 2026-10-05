<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PublicResumeController extends Controller
{
    public function showPasswordForm(string $publicLink)
    {
        $resume = Resume::where('public_link', $publicLink)
            ->where('status', 'active')
            ->firstOrFail();

        if (!$resume->resume_password_hash) {
            return redirect()->route('public.resume.view', $resume->public_link);
        }

        return view('public.resume-password', compact('resume'));
    }

    public function verifyPassword(Request $request, string $publicLink)
    {
        $resume = Resume::where('public_link', $publicLink)
            ->where('status', 'active')
            ->firstOrFail();

        if (!$resume->resume_password_hash) {
            return redirect()->route('public.resume.view', $resume->public_link);
        }

        $request->validate([
            'resume_password' => ['required', 'string'],
        ]);

        if (!Hash::check($request->resume_password, $resume->resume_password_hash)) {
            return redirect()
                ->back()
                ->with('error', 'Incorrect password.');
        }

        session([
            'public_resume_access_' . $resume->id => $resume->publicAccessToken(),
        ]);

        return redirect()->route('public.resume.view', $resume->public_link);
    }

    public function view(string $publicLink)
    {
        $resume = Resume::with([
            'user.profile',
            'skills',
            'languages',
            'interests',
            'experiences',
            'educations',
            'projects',
            'certificates',
        ])
            ->where('public_link', $publicLink)
            ->where('status', 'active')
            ->firstOrFail();

        if (!$resume->allowsPublicAccess(request())) {
            return redirect()->route('public.resume.password', $resume->public_link);
        }

        /*
        |--------------------------------------------------------------------------
        | Track Resume View
        |--------------------------------------------------------------------------
        | This counter is only stored in the database.
        | It must NOT be shown to the employer on the public resume page.
        */
        $resume->increment('view_count');

        $resume->update([
            'last_viewed_at' => now(),
        ]);

        return view('public.resume-view', compact('resume'));
    }

    public function downloadGeneratedPdf(string $publicLink)
    {
        $resume = Resume::with([
            'user.profile',
            'skills',
            'languages',
            'interests',
            'experiences',
            'educations',
            'projects',
            'certificates',
        ])
            ->where('public_link', $publicLink)
            ->where('status', 'active')
            ->firstOrFail();

        if (!$resume->allowsPublicAccess(request())) {
            return redirect()->route('public.resume.password', $resume->public_link);
        }

        if (!in_array($resume->download_resume_type, ['generated', 'both'], true)) {
            abort(403, 'Generated PDF download is not enabled for this resume.');
        }

        $fileName = str_replace(' ', '-', strtolower($resume->full_name ?: $resume->title)) . '-generated-resume.pdf';

        $pdf = Pdf::loadView('public.resume-pdf', [
            'resume' => $resume,
        ])->setPaper('a4', 'portrait');

        return $pdf->download($fileName);
    }

    public function downloadUploadedPdf(string $publicLink)
    {
        $resume = Resume::where('public_link', $publicLink)
            ->where('status', 'active')
            ->firstOrFail();

        if (!$resume->allowsPublicAccess(request())) {
            return redirect()->route('public.resume.password', $resume->public_link);
        }

        if (!in_array($resume->download_resume_type, ['uploaded', 'both'], true)) {
            abort(403, 'Uploaded PDF download is not enabled for this resume.');
        }

        if (
            !$resume->uploaded_resume_file ||
            !Storage::disk('private')->exists($resume->uploaded_resume_file)
        ) {
            abort(404, 'Uploaded resume file not found.');
        }

        $fileName = str_replace(' ', '-', strtolower($resume->full_name ?: $resume->title)) . '-uploaded-resume.pdf';

        return Storage::disk('private')->download($resume->uploaded_resume_file, $fileName);
    }
}