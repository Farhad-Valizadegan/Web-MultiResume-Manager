<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeFileController extends Controller
{
    public function show(Request $request, Resume $resume, string $type, ?int $certificate = null)
    {
        $owner = $request->user() && (
            $request->user()->id === $resume->user_id || $request->user()->role === 'admin'
        );
        if (!$owner) {
            abort_unless($resume->status === 'active', 404);
            abort_unless($resume->allowsPublicAccess($request), 403);
            if ($type === 'uploaded') {
                abort_unless(in_array($resume->download_resume_type, ['uploaded', 'both'], true), 403);
            }
        }

        $path = match ($type) {
            'photo' => $resume->profile_photo,
            'uploaded' => $resume->uploaded_resume_file,
            'certificate' => $resume->certificates()->findOrFail($certificate)->certificate_file,
            default => null,
        };
        abort_unless($path && Storage::disk('private')->exists($path), 404);
        return Storage::disk('private')->response($path, null, ['X-Content-Type-Options' => 'nosniff']);
    }
}
