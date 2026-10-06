<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ResumeController extends Controller
{
    public function __construct(private \App\Services\ResumeFiles $files) {}

    public function store(Request $request)
    {
        return $this->files->transaction(fn () => $this->storeResume($request));
    }

    public function update(Request $request, Resume $resume)
    {
        return $this->files->transaction(fn () => $this->updateResume($request, $resume));
    }

    public function destroy(Resume $resume)
    {
        return $this->files->transaction(fn () => $this->destroyResume($resume));
    }

    public function index()
    {
        $resumes = auth()->user()
            ->resumes()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.resumes.index', compact('resumes'));
    }

    public function create()
    {
        return view('user.resumes.create');
    }

    private function storeResume(Request $request)
    {
        $this->normalizeResumeMonths($request);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'job_position' => ['nullable', 'string', 'max:255'],
            'resume_password' => ['nullable', 'string', 'min:6'],
            'full_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'postal_code' => ['nullable', 'string', 'max:30'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:2048'],
            'linkedin' => ['nullable', 'url', 'max:2048'],
            'github' => ['nullable', 'url', 'max:2048'],
            'professional_summary' => ['nullable', 'string'],
            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'uploaded_resume_file' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5120',
            ],
            'download_resume_type' => [
                'required',
                'in:generated,uploaded,both',
            ],
            'skill_display_style' => [
                'required',
                'string',
                'in:compact,cards',
            ],
            'theme' => [
                'required',
                'string',
                'in:professional_blue,dark_modern,minimal_light',
            ],

            'skills' => ['nullable', 'array'],
            'skills.*.skill_category' => [
                'nullable',
                'string',
                'max:255',
            ],
            'skills.*.skill_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'skills.*.evidence_label' => ['nullable', 'string', 'max:100'],
            'skills.*.evidence_url' => ['nullable', 'url:http,https', 'max:2048'],
            'skills.*.skill_level' => [
                'nullable',
                'string',
                'max:255',
            ],

            'languages' => ['nullable', 'array'],
            'languages.*.language_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'languages.*.proficiency_level' => [
                'nullable',
                'string',
                'max:255',
            ],

            'interests' => ['nullable', 'array'],
            'interests.*.interest_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'interests.*.description' => [
                'nullable',
                'string',
            ],

            'educations' => ['nullable', 'array'],
            'educations.*.institution_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'educations.*.degree' => [
                'nullable',
                'string',
                'max:255',
            ],
            'educations.*.field_of_study' => [
                'nullable',
                'string',
                'max:255',
            ],
            'educations.*.start_date' => [
                'nullable',
                'date',
            ],
            'educations.*.end_date' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $start = $request->input(str_replace('.end_date', '.start_date', $attribute));
                    if (is_string($start) && is_string($value)
                        && preg_match('/^\d{4}-\d{2}-\d{2}$/', $start)
                        && preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)
                        && substr($value, 0, 7) < substr($start, 0, 7)) {
                        $fail('The end month must be the same as or after the start month.');
                    }
                },
            ],
            'educations.*.description' => [
                'nullable',
                'string',
            ],

            'experiences' => ['nullable', 'array'],
            'experiences.*.company_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'experiences.*.job_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'experiences.*.start_date' => [
                'nullable',
                'date',
                'before_or_equal:today',
            ],
            'experiences.*.end_date' => [
                'nullable',
                'date',
                'before_or_equal:today',
                function ($attribute, $value, $fail) use ($request) {
                    $start = $request->input(str_replace('.end_date', '.start_date', $attribute));
                    if (is_string($start) && is_string($value)
                        && preg_match('/^\d{4}-\d{2}-\d{2}$/', $start)
                        && preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)
                        && substr($value, 0, 7) < substr($start, 0, 7)) {
                        $fail('The end month must be the same as or after the start month.');
                    }
                },
            ],
            'experiences.*.description' => [
                'nullable',
                'string',
            ],

            'projects' => ['nullable', 'array'],
            'projects.*.project_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'projects.*.project_description' => [
                'nullable',
                'string',
            ],
            'projects.*.project_link_label' => ['nullable', 'string', 'max:100'],
            'projects.*.demo_label' => ['nullable', 'string', 'max:100'],
            'projects.*.demo_url' => ['nullable', 'url:http,https', 'max:2048'],
            'projects.*.project_link' => [
                'nullable',
                'url:http,https',
                'max:255',
            ],

            'certificates' => ['nullable', 'array'],
            'certificates.*.certificate_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'certificates.*.issuer' => [
                'nullable',
                'string',
                'max:255',
            ],
            'certificates.*.issue_date' => [
                'nullable',
                'date',
            ],
            'certificates.*.credential_id' => [
                'nullable',
                'string',
                'max:255',
            ],
            'certificates.*.credential_url' => [
                'nullable',
                'url',
                'max:255',
            ],
            'certificates.*.certificate_file' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png,webp',
                'max:4096',
            ],
            'certificates.*.description' => [
                'nullable',
                'string',
            ],
            'certificates.*.related_project_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'certificates.*.related_project_link' => [
                'nullable',
                'url',
                'max:255',
            ],
        ]);

        if (
            in_array(
                $validated['download_resume_type'],
                ['uploaded', 'both'],
                true
            )
            && !$request->hasFile('uploaded_resume_file')
        ) {
            return back()
                ->withErrors([
                    'uploaded_resume_file' =>
                        'Please upload a PDF resume file or choose Generated Resume PDF only.',
                ])
                ->withInput();
        }

        $uploadedResumeFilePath = null;

        if ($request->hasFile('uploaded_resume_file')) {
            $uploadedResumeFilePath = $this->files->store($request->file('uploaded_resume_file'), 'uploaded-resumes');
        }

        $profilePhotoPath = null;

        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $this->files->store($request->file('profile_photo'), 'resume-profile-photos');
        }

        $resume = Resume::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'job_position' => $validated['job_position'] ?? null,
            'full_name' => $validated['full_name'] ?? null,
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'postal_code' => $validated['postal_code'] ?? null,
            'city' => $validated['city'] ?? null,
            'country' => $validated['country'] ?? null,
            'website' => $validated['website'] ?? null,
            'linkedin' => $validated['linkedin'] ?? null,
            'github' => $validated['github'] ?? null,
            'profile_photo' => $profilePhotoPath,
            'professional_summary' =>
                $validated['professional_summary'] ?? null,
            'public_link' => $this->generateUniquePublicLink(),
            'resume_password_hash' => !empty($validated['resume_password'])
                ? Hash::make($validated['resume_password'])
                : null,
            'uploaded_resume_file' => $uploadedResumeFilePath,
            'download_resume_type' =>
                $validated['download_resume_type'],
            'skill_display_style' =>
                $validated['skill_display_style'],
            'theme' => $validated['theme'],
            'status' => 'active',
        ]);

        $this->saveResumeDetails(
            $request,
            $validated,
            $resume
        );

        return redirect()
            ->route('user.resumes.index')
            ->with('success', 'Resume created successfully.');
    }

    public function edit(Resume $resume)
    {
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        $resume->load([
            'skills',
            'languages',
            'interests',
            'educations',
            'experiences',
            'projects',
            'certificates',
        ]);

        return view('user.resumes.edit', compact('resume'));
    }

    private function updateResume(Request $request, Resume $resume)
    {
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        $this->normalizeResumeMonths($request);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'job_position' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:active,inactive'],
            'full_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'postal_code' => ['nullable', 'string', 'max:30'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:2048'],
            'linkedin' => ['nullable', 'url', 'max:2048'],
            'github' => ['nullable', 'url', 'max:2048'],
            'professional_summary' => ['nullable', 'string'],
            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'remove_profile_photo' => ['nullable', 'boolean'],

            'uploaded_resume_file' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5120',
            ],
            'download_resume_type' => [
                'required',
                'in:generated,uploaded,both',
            ],
            'skill_display_style' => [
                'required',
                'string',
                'in:compact,cards',
            ],
            'theme' => [
                'required',
                'string',
                'in:professional_blue,dark_modern,minimal_light',
            ],

            'skills' => ['nullable', 'array'],
            'skills.*.skill_category' => [
                'nullable',
                'string',
                'max:255',
            ],
            'skills.*.skill_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'skills.*.evidence_label' => ['nullable', 'string', 'max:100'],
            'skills.*.evidence_url' => ['nullable', 'url:http,https', 'max:2048'],
            'skills.*.skill_level' => [
                'nullable',
                'string',
                'max:255',
            ],

            'languages' => ['nullable', 'array'],
            'languages.*.language_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'languages.*.proficiency_level' => [
                'nullable',
                'string',
                'max:255',
            ],

            'interests' => ['nullable', 'array'],
            'interests.*.interest_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'interests.*.description' => [
                'nullable',
                'string',
            ],

            'educations' => ['nullable', 'array'],
            'educations.*.institution_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'educations.*.degree' => [
                'nullable',
                'string',
                'max:255',
            ],
            'educations.*.field_of_study' => [
                'nullable',
                'string',
                'max:255',
            ],
            'educations.*.start_date' => [
                'nullable',
                'date',
            ],
            'educations.*.end_date' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $start = $request->input(str_replace('.end_date', '.start_date', $attribute));
                    if (is_string($start) && is_string($value)
                        && preg_match('/^\d{4}-\d{2}-\d{2}$/', $start)
                        && preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)
                        && substr($value, 0, 7) < substr($start, 0, 7)) {
                        $fail('The end month must be the same as or after the start month.');
                    }
                },
            ],
            'educations.*.description' => [
                'nullable',
                'string',
            ],

            'experiences' => ['nullable', 'array'],
            'experiences.*.company_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'experiences.*.job_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'experiences.*.start_date' => [
                'nullable',
                'date',
                'before_or_equal:today',
            ],
            'experiences.*.end_date' => [
                'nullable',
                'date',
                'before_or_equal:today',
                function ($attribute, $value, $fail) use ($request) {
                    $start = $request->input(str_replace('.end_date', '.start_date', $attribute));
                    if (is_string($start) && is_string($value)
                        && preg_match('/^\d{4}-\d{2}-\d{2}$/', $start)
                        && preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)
                        && substr($value, 0, 7) < substr($start, 0, 7)) {
                        $fail('The end month must be the same as or after the start month.');
                    }
                },
            ],
            'experiences.*.description' => [
                'nullable',
                'string',
            ],

            'projects' => ['nullable', 'array'],
            'projects.*.project_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'projects.*.project_description' => [
                'nullable',
                'string',
            ],
            'projects.*.project_link_label' => ['nullable', 'string', 'max:100'],
            'projects.*.demo_label' => ['nullable', 'string', 'max:100'],
            'projects.*.demo_url' => ['nullable', 'url:http,https', 'max:2048'],
            'projects.*.project_link' => [
                'nullable',
                'url:http,https',
                'max:255',
            ],

            'certificates' => ['nullable', 'array'],
            'certificates.*.id' => [
                'nullable',
                'integer',
                'distinct',
                Rule::exists('resume_certificates', 'id')
                    ->where(
                        fn ($query) =>
                            $query->where('resume_id', $resume->id)
                    ),
            ],
            'certificates.*.certificate_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'certificates.*.issuer' => [
                'nullable',
                'string',
                'max:255',
            ],
            'certificates.*.issue_date' => [
                'nullable',
                'date',
            ],
            'certificates.*.credential_id' => [
                'nullable',
                'string',
                'max:255',
            ],
            'certificates.*.credential_url' => [
                'nullable',
                'url',
                'max:255',
            ],
            'certificates.*.certificate_file' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png,webp',
                'max:4096',
            ],
            'certificates.*.description' => [
                'nullable',
                'string',
            ],
            'certificates.*.related_project_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'certificates.*.related_project_link' => [
                'nullable',
                'url',
                'max:255',
            ],
        ]);

        if (
            in_array(
                $validated['download_resume_type'],
                ['uploaded', 'both'],
                true
            )
            && !$request->hasFile('uploaded_resume_file')
            && !$resume->uploaded_resume_file
        ) {
            return back()
                ->withErrors([
                    'uploaded_resume_file' =>
                        'Please upload a PDF resume file or choose Generated Resume PDF only.',
                ])
                ->withInput();
        }

        $uploadedResumeFilePath = $resume->uploaded_resume_file;

        if ($request->hasFile('uploaded_resume_file')) {
            $newUploadedResumeFilePath = $this->files->store($request->file('uploaded_resume_file'), 'uploaded-resumes');

            if ($resume->uploaded_resume_file) {
                $this->files->delete($resume->uploaded_resume_file);
            }

            $uploadedResumeFilePath = $newUploadedResumeFilePath;
        }

        $profilePhotoPath = $resume->profile_photo;

        if ($request->boolean('remove_profile_photo')) {
            if ($profilePhotoPath) {
                $this->files->delete($profilePhotoPath);
            }

            $profilePhotoPath = null;
        }

        if ($request->hasFile('profile_photo')) {
            $newProfilePhotoPath = $this->files->store($request->file('profile_photo'), 'resume-profile-photos');

            if ($profilePhotoPath) {
                $this->files->delete($profilePhotoPath);
            }

            $profilePhotoPath = $newProfilePhotoPath;
        }

        $resume->update([
            'title' => $validated['title'],
            'job_position' => $validated['job_position'] ?? null,
            'full_name' => $validated['full_name'] ?? null,
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'postal_code' => $validated['postal_code'] ?? null,
            'city' => $validated['city'] ?? null,
            'country' => $validated['country'] ?? null,
            'website' => $validated['website'] ?? null,
            'linkedin' => $validated['linkedin'] ?? null,
            'github' => $validated['github'] ?? null,
            'profile_photo' => $profilePhotoPath,
            'professional_summary' =>
                $validated['professional_summary'] ?? null,
            'status' => $validated['status'],
            'uploaded_resume_file' => $uploadedResumeFilePath,
            'download_resume_type' =>
                $validated['download_resume_type'],
            'skill_display_style' =>
                $validated['skill_display_style'],
            'theme' => $validated['theme'],
        ]);

        $this->deleteReplaceableResumeDetails($resume);

        $this->saveReplaceableResumeDetails(
            $validated,
            $resume
        );

        $this->syncCertificates(
            $request,
            $validated,
            $resume
        );

        return redirect()
            ->route('user.resumes.index')
            ->with('success', 'Resume updated successfully.');
    }

    private function destroyResume(Resume $resume)
    {
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        $resume->delete();

        return redirect()
            ->route('user.resumes.index')
            ->with('success', 'Resume deleted successfully.');
    }

    public function password(Resume $resume)
    {
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('user.resumes.password', compact('resume'));
    }

    public function updatePassword(
        Request $request,
        Resume $resume
    ) {
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'resume_password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],
        ]);

        $resume->update([
            'resume_password_hash' =>
                Hash::make($validated['resume_password']),
        ]);

        return redirect()
            ->route('user.resumes.index')
            ->with(
                'success',
                'Resume password updated successfully.'
            );
    }

    private function saveResumeDetails(
        Request $request,
        array $validated,
        Resume $resume
    ): void {
        $this->saveReplaceableResumeDetails(
            $validated,
            $resume
        );

        foreach (
            $validated['certificates'] ?? []
            as $index => $certificate
        ) {
            if (empty($certificate['certificate_title'])) {
                continue;
            }

            $certificateFilePath = null;

            if (
                $request->hasFile(
                    "certificates.$index.certificate_file"
                )
            ) {
                $certificateFilePath = $this->files->store($request->file("certificates.$index.certificate_file"), 'certificate-files');
            }

            $resume->certificates()->create(
                $this->certificateAttributes(
                    $certificate,
                    $certificateFilePath
                )
            );
        }
    }

    private function normalizeResumeMonths(Request $request): void
    {
        foreach (['experiences' => ['start_date', 'end_date'], 'educations' => ['start_date', 'end_date']] as $group => $fields) {
            $rows = $request->input($group);
            if (!is_array($rows)) {
                continue;
            }
            foreach ($rows as &$row) {
                if (!is_array($row)) {
                    continue;
                }
                foreach ($fields as $field) {
                    $value = $row[$field] ?? null;
                    if (is_string($value) && preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $value)) {
                        $row[$field] = $value.'-01';
                    }
                }
            }
            unset($row);
            $request->merge([$group => $rows]);
        }
    }

    private function saveReplaceableResumeDetails(
        array $validated,
        Resume $resume
    ): void {
        foreach ($validated['skills'] ?? [] as $skill) {
            if (!empty($skill['skill_name'])) {
                $resume->skills()->create([
                    'skill_category' =>
                        $skill['skill_category'] ?? null,
                    'skill_name' => $skill['skill_name'],
                    'evidence_url' => $skill['evidence_url'] ?? null,
                    'evidence_label' => $skill['evidence_label'] ?? null,
                    'skill_level' =>
                        $skill['skill_level'] ?? null,
                ]);
            }
        }

        foreach (
            $validated['languages'] ?? []
            as $language
        ) {
            if (!empty($language['language_name'])) {
                $resume->languages()->create([
                    'language_name' =>
                        $language['language_name'],
                    'proficiency_level' =>
                        $language['proficiency_level'] ?? null,
                ]);
            }
        }

        foreach (
            $validated['interests'] ?? []
            as $interest
        ) {
            if (!empty($interest['interest_name'])) {
                $resume->interests()->create([
                    'interest_name' =>
                        $interest['interest_name'],
                    'description' =>
                        $interest['description'] ?? null,
                ]);
            }
        }

        foreach (
            $validated['educations'] ?? []
            as $education
        ) {
            if (!empty($education['institution_name'])) {
                $resume->educations()->create([
                    'institution_name' =>
                        $education['institution_name'],
                    'degree' =>
                        $education['degree'] ?? null,
                    'field_of_study' =>
                        $education['field_of_study'] ?? null,
                    'start_date' =>
                        $education['start_date'] ?? null,
                    'end_date' =>
                        $education['end_date'] ?? null,
                    'description' =>
                        $education['description'] ?? null,
                ]);
            }
        }

        foreach (
            $validated['experiences'] ?? []
            as $experience
        ) {
            if (
                !empty($experience['company_name'])
                || !empty($experience['job_title'])
            ) {
                $resume->experiences()->create([
                    'company_name' =>
                        $experience['company_name']
                            ?? 'Not specified',
                    'job_title' =>
                        $experience['job_title']
                            ?? 'Not specified',
                    'start_date' =>
                        $experience['start_date'] ?? null,
                    'end_date' =>
                        $experience['end_date'] ?? null,
                    'description' =>
                        $experience['description'] ?? null,
                ]);
            }
        }

        foreach ($validated['projects'] ?? [] as $project) {
            if (!empty($project['project_title'])) {
                $resume->projects()->create([
                    'project_title' =>
                        $project['project_title'],
                    'project_description' =>
                        $project['project_description'] ?? null,
                    'project_link' =>
                        $project['project_link'] ?? null,
                    'project_link_label' => $project['project_link_label'] ?? null,
                    'demo_label' => $project['demo_label'] ?? null,
                    'demo_url' => $project['demo_url'] ?? null,
                ]);
            }
        }
    }

    private function syncCertificates(
        Request $request,
        array $validated,
        Resume $resume
    ): void {
        $existingCertificates = $resume
            ->certificates()
            ->get()
            ->keyBy('id');

        $retainedCertificateIds = [];

        foreach (
            $validated['certificates'] ?? []
            as $index => $certificateData
        ) {
            if (empty($certificateData['certificate_title'])) {
                continue;
            }

            $certificateId = $certificateData['id'] ?? null;

            if ($certificateId !== null) {
                $certificate = $existingCertificates->get(
                    (int) $certificateId
                );

                if (!$certificate) {
                    continue;
                }

                $certificateFilePath =
                    $certificate->certificate_file;

                if (
                    $request->hasFile(
                        "certificates.$index.certificate_file"
                    )
                ) {
                    $newCertificateFilePath = $this->files->store($request->file("certificates.$index.certificate_file"), 'certificate-files');

                    if ($certificate->certificate_file) {
                        $this->files->delete(
                            $certificate->certificate_file
                        );
                    }

                    $certificateFilePath =
                        $newCertificateFilePath;
                }

                $certificate->update(
                    $this->certificateAttributes(
                        $certificateData,
                        $certificateFilePath
                    )
                );

                $retainedCertificateIds[] = $certificate->id;

                continue;
            }

            $certificateFilePath = null;

            if (
                $request->hasFile(
                    "certificates.$index.certificate_file"
                )
            ) {
                $certificateFilePath = $this->files->store($request->file("certificates.$index.certificate_file"), 'certificate-files');
            }

            $certificate = $resume
                ->certificates()
                ->create(
                    $this->certificateAttributes(
                        $certificateData,
                        $certificateFilePath
                    )
                );

            $retainedCertificateIds[] = $certificate->id;
        }

        $certificatesToRemove = $resume
            ->certificates()
            ->whereNotIn('id', $retainedCertificateIds)
            ->get();

        foreach ($certificatesToRemove as $certificate) {
            if ($certificate->certificate_file) {
                $this->files->delete(
                    $certificate->certificate_file
                );
            }

            $certificate->delete();
        }
    }

    private function certificateAttributes(
        array $certificate,
        ?string $certificateFilePath
    ): array {
        return [
            'certificate_title' =>
                $certificate['certificate_title'],
            'issuer' =>
                $certificate['issuer'] ?? null,
            'issue_date' =>
                $certificate['issue_date'] ?? null,
            'credential_id' =>
                $certificate['credential_id'] ?? null,
            'credential_url' =>
                $certificate['credential_url'] ?? null,
            'certificate_file' =>
                $certificateFilePath,
            'description' =>
                $certificate['description'] ?? null,
            'related_project_title' =>
                $certificate['related_project_title'] ?? null,
            'related_project_link' =>
                $certificate['related_project_link'] ?? null,
        ];
    }

    private function deleteReplaceableResumeDetails(
        Resume $resume
    ): void {
        $resume->skills()->delete();
        $resume->languages()->delete();
        $resume->interests()->delete();
        $resume->educations()->delete();
        $resume->experiences()->delete();
        $resume->projects()->delete();
    }

    private function generateUniquePublicLink(): string
    {
        do {
            $publicLink =
                'r-' . Str::lower(Str::random(8));
        } while (
            Resume::where('public_link', $publicLink)->exists()
        );

        return $publicLink;
    }
}