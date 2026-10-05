<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-ink leading-tight">
                    Resume Details
                </h2>

                <p class="text-sm text-muted mt-1">
                    View resume information, owner details, access settings, and resume content.
                </p>
            </div>

            <a href="{{ route('admin.resumes.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-slate-800 text-white rounded-md hover:bg-slate-900 font-semibold">
                Back to Manage Resumes
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-canvas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @php
                $publicUrl = url('/resume/' . $resume->public_link);
            @endphp

            <div id="copy-message" class="hidden mb-4 p-4 bg-blue-soft border border-blue-soft text-blue-strong rounded-md font-semibold">
                Public resume link copied successfully.
            </div>

            <div class="bg-surface-soft shadow-sm sm:rounded-xl p-4 sm:p-6 border border-line space-y-6">

                <!-- Page Intro -->
                <section class="bg-surface border border-line rounded-xl p-5">
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">
                        <div>
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-surface-soft text-muted">
                                    ID: {{ $resume->id }}
                                </span>

                                @if ($resume->status === 'active')
                                    <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-green-soft text-green-strong">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-red-soft text-red-strong">
                                        Inactive
                                    </span>
                                @endif

                                <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-blue-soft text-blue-strong">
                                    {{ $resume->view_count ?? 0 }} views
                                </span>
                            </div>

                            <h3 class="text-2xl font-bold text-ink wrap-break-word">
                                {{ $resume->title }}
                            </h3>

                            <p class="text-muted mt-2 wrap-break-word">
                                Job Position:
                                <span class="font-semibold text-ink">
                                    {{ $resume->job_position ?? 'Not specified' }}
                                </span>
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row lg:flex-col gap-2 w-full sm:w-auto">
                            <a href="{{ $publicUrl }}"
                               target="_blank"
                               class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                                Open Public Link
                            </a>

                            <button type="button"
                                    onclick="copyResumeLink('{{ $publicUrl }}')"
                                    class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-slate-700 text-white rounded-md hover:bg-slate-800 font-semibold">
                                Copy Public Link
                            </button>
                        </div>
                    </div>
                </section>

                <!-- Owner and Analytics -->
                <section class="bg-surface border border-line rounded-xl p-5">
                    <h4 class="text-lg font-bold text-ink mb-4">
                        Owner and Analytics
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                        <div class="bg-surface-soft border border-line rounded-md p-4">
                            <p class="text-xs text-muted font-bold uppercase tracking-wide">
                                Owner
                            </p>
                            <p class="font-bold text-ink mt-1 wrap-break-word">
                                {{ $resume->user->name ?? 'Unknown' }}
                            </p>
                        </div>

                        <div class="bg-surface-soft border border-line rounded-md p-4">
                            <p class="text-xs text-muted font-bold uppercase tracking-wide">
                                Email
                            </p>
                            <p class="font-bold text-ink mt-1 break-all">
                                {{ $resume->user->email ?? 'Unknown' }}
                            </p>
                        </div>

                        <div class="bg-surface-soft border border-line rounded-md p-4">
                            <p class="text-xs text-muted font-bold uppercase tracking-wide">
                                Last Viewed
                            </p>
                            <p class="font-bold text-ink mt-1">
                                @if ($resume->last_viewed_at)
                                    {{ $resume->last_viewed_at->format('Y-m-d H:i') }}
                                @else
                                    <span class="text-slate-400">Never viewed</span>
                                @endif
                            </p>
                        </div>

                        <div class="bg-surface-soft border border-line rounded-md p-4">
                            <p class="text-xs text-muted font-bold uppercase tracking-wide">
                                Created
                            </p>
                            <p class="font-bold text-ink mt-1">
                                {{ $resume->created_at->format('Y-m-d H:i') }}
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Access Information -->
                <section class="bg-surface border border-line rounded-xl p-5">
                    <h4 class="text-lg font-bold text-ink mb-4">
                        Access and Download Information
                    </h4>

                    <div class="space-y-4">
                        <div class="bg-surface-soft border border-line rounded-md p-4">
                            <p class="text-sm text-muted font-bold mb-2">
                                Public Link
                            </p>

                            <div class="flex flex-col lg:flex-row lg:items-center gap-2">
                                <input type="text"
                                       value="{{ $publicUrl }}"
                                       readonly
                                       class="w-full lg:flex-1 border border-line rounded-md shadow-xs font-mono text-sm px-3 py-2">

                                <button type="button"
                                        onclick="copyResumeLink('{{ $publicUrl }}')"
                                        class="w-full lg:w-auto inline-flex justify-center px-4 py-2 bg-slate-700 text-white rounded-md hover:bg-slate-800 font-semibold">
                                    Copy Link
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-surface-soft border border-line rounded-md p-4">
                                <p class="text-xs text-muted font-bold uppercase tracking-wide">
                                    Employer Password
                                </p>

                                @if ($resume->resume_password_hash)
                                    <p class="font-mono bg-surface border border-line px-2 py-1 rounded-md mt-2 break-all inline-block">
                                        Password set (hidden)
                                    </p>
                                @else
                                    <p class="text-red-strong font-semibold mt-2">
                                        No password set
                                    </p>
                                @endif
                            </div>

                            <div class="bg-surface-soft border border-line rounded-md p-4">
                                <p class="text-xs text-muted font-bold uppercase tracking-wide">
                                    Access Status
                                </p>

                                <p class="font-bold text-ink mt-2">
                                    @if ($resume->resume_password_hash)
                                        Password Required
                                    @else
                                        Public Without Password
                                    @endif
                                </p>
                            </div>

                            <div class="bg-surface-soft border border-line rounded-md p-4">
                                <p class="text-xs text-muted font-bold uppercase tracking-wide">
                                    Download Option
                                </p>

                                <p class="font-bold text-ink mt-2">
                                    @if ($resume->download_resume_type === 'generated')
                                        Generated PDF only
                                    @elseif ($resume->download_resume_type === 'uploaded')
                                        Uploaded PDF only
                                    @elseif ($resume->download_resume_type === 'both')
                                        Generated and Uploaded PDF
                                    @else
                                        Not specified
                                    @endif
                                </p>
                            </div>
                        </div>

                        @if ($resume->uploaded_resume_file)
                            <a href="{{ route('resume.files.show', [$resume, 'uploaded']) }}"
                               target="_blank"
                               class="inline-flex px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                                View Uploaded Resume PDF
                            </a>
                        @endif
                    </div>
                </section>

                <!-- Skills -->
                <section class="bg-surface border border-line rounded-xl p-5">
                    <h4 class="text-lg font-bold text-ink mb-4">
                        Skills
                    </h4>

                    @if ($resume->skills->count())
                        @php
                            $groupedSkills = $resume->skills->groupBy(function ($skill) {
                                return $skill->skill_category ?: 'Other Skills';
                            });
                        @endphp

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                            @foreach ($groupedSkills as $category => $skills)
                                <div class="bg-surface-soft border border-line rounded-md p-4">
                                    <h5 class="font-bold text-ink mb-3">
                                        {{ $category }}
                                    </h5>

                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($skills as $skill)
                                            <span class="inline-flex px-3 py-1 rounded-md bg-blue-soft text-blue-strong text-sm font-bold">
                                                {{ $skill->skill_name }}
                                                @if ($skill->skill_level)
                                                    - {{ $skill->skill_level }}
                                                @endif
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">
                            No skills added.
                        </p>
                    @endif
                </section>

                <!-- Languages and Interests -->
                <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-surface border border-line rounded-xl p-5">
                        <h4 class="text-lg font-bold text-ink mb-4">
                            Languages
                        </h4>

                        <div class="space-y-3">
                            @forelse ($resume->languages as $language)
                                <div class="bg-surface-soft border border-line rounded-md p-4">
                                    <p class="font-bold text-ink">
                                        {{ $language->language_name }}
                                    </p>

                                    @if ($language->proficiency_level)
                                        <p class="text-muted mt-1">
                                            {{ $language->proficiency_level }}
                                        </p>
                                    @endif
                                </div>
                            @empty
                                <p class="text-muted">
                                    No languages added.
                                </p>
                            @endforelse
                        </div>
                    </div>

                    <div class="bg-surface border border-line rounded-xl p-5">
                        <h4 class="text-lg font-bold text-ink mb-4">
                            Hobbies & Interests
                        </h4>

                        <div class="space-y-3">
                            @forelse ($resume->interests as $interest)
                                <div class="bg-surface-soft border border-line rounded-md p-4">
                                    <p class="font-bold text-ink">
                                        {{ $interest->interest_name }}
                                    </p>

                                    @if ($interest->description)
                                        <p class="text-muted mt-2">
                                            {{ $interest->description }}
                                        </p>
                                    @endif
                                </div>
                            @empty
                                <p class="text-muted">
                                    No hobbies or interests added.
                                </p>
                            @endforelse
                        </div>
                    </div>
                </section>

                <!-- Education -->
                <section class="bg-surface border border-line rounded-xl p-5">
                    <h4 class="text-lg font-bold text-ink mb-4">
                        Education
                    </h4>

                    <div class="space-y-4">
                        @forelse ($resume->educations as $education)
                            <div class="bg-surface-soft border border-line rounded-md p-4">
                                <p class="font-bold text-ink">
                                    {{ $education->institution_name }}
                                </p>

                                <p class="text-muted mt-1">
                                    {{ $education->degree }}
                                    @if ($education->field_of_study)
                                        - {{ $education->field_of_study }}
                                    @endif
                                </p>

                                <p class="text-muted text-sm mt-1">
                                    {{ $education->start_date }} - {{ $education->end_date ?? 'Present' }}
                                </p>

                                @if ($education->description)
                                    <p class="text-muted mt-3">
                                        {{ $education->description }}
                                    </p>
                                @endif
                            </div>
                        @empty
                            <p class="text-muted">
                                No education added.
                            </p>
                        @endforelse
                    </div>
                </section>

                <!-- Experience -->
                <section class="bg-surface border border-line rounded-xl p-5">
                    <h4 class="text-lg font-bold text-ink mb-4">
                        Work Experience / Internship
                    </h4>

                    <div class="space-y-4">
                        @forelse ($resume->experiences as $experience)
                            <div class="bg-surface-soft border border-line rounded-md p-4">
                                <p class="font-bold text-ink">
                                    {{ $experience->job_title }}
                                </p>

                                <p class="text-muted mt-1">
                                    {{ $experience->company_name }}
                                </p>

                                <p class="text-muted text-sm mt-1">
                                    {{ $experience->start_date }} - {{ $experience->end_date ?? 'Present' }}
                                </p>

                                @if ($experience->description)
                                    <p class="text-muted mt-3">
                                        {{ $experience->description }}
                                    </p>
                                @endif
                            </div>
                        @empty
                            <p class="text-muted">
                                No work experience added.
                            </p>
                        @endforelse
                    </div>
                </section>

                <!-- Certificates -->
                <section class="bg-surface border border-line rounded-xl p-5">
                    <h4 class="text-lg font-bold text-ink mb-4">
                        Licenses & Certifications
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse ($resume->certificates as $certificate)
                            <div class="bg-surface-soft border border-line rounded-md p-4">
                                <p class="font-bold text-ink">
                                    {{ $certificate->certificate_title }}
                                </p>

                                @if ($certificate->issuer)
                                    <p class="text-muted mt-1">
                                        Issuer: {{ $certificate->issuer }}
                                    </p>
                                @endif

                                @if ($certificate->issue_date)
                                    <p class="text-muted text-sm mt-1">
                                        Issued: {{ $certificate->issue_date }}
                                    </p>
                                @endif

                                @if ($certificate->credential_id)
                                    <p class="text-muted text-sm mt-1">
                                        Credential ID: {{ $certificate->credential_id }}
                                    </p>
                                @endif

                                @if ($certificate->description)
                                    <p class="text-muted mt-3">
                                        {{ $certificate->description }}
                                    </p>
                                @endif

                                <div class="flex flex-wrap gap-2 mt-3">
                                    @if ($certificate->credential_url)
                                        <a href="{{ $certificate->credential_url }}"
                                           target="_blank"
                                           class="inline-flex px-3 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold text-sm">
                                            View Credential
                                        </a>
                                    @endif

                                    @if ($certificate->certificate_file)
                                        <a href="{{ route('resume.files.show', [$resume, 'certificate', $certificate->id]) }}"
                                           target="_blank"
                                           class="inline-flex px-3 py-1.5 bg-slate-700 text-white rounded-md hover:bg-slate-800 font-semibold text-sm">
                                            View File
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">
                                No certificates added.
                            </p>
                        @endforelse
                    </div>
                </section>

                <!-- Projects -->
                <section class="bg-surface border border-line rounded-xl p-5">
                    <h4 class="text-lg font-bold text-ink mb-4">
                        Projects
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse ($resume->projects as $project)
                            <div class="bg-surface-soft border border-line rounded-md p-4">
                                <p class="font-bold text-ink">
                                    {{ $project->project_title }}
                                </p>

                                @if ($project->project_description)
                                    <p class="text-muted mt-2">
                                        {{ $project->project_description }}
                                    </p>
                                @endif

                                @if ($project->project_link)
                                    <a href="{{ $project->project_link }}"
                                       target="_blank"
                                       class="inline-flex mt-3 px-3 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold text-sm">
                                        View Project
                                    </a>
                                @endif
                            </div>
                        @empty
                            <p class="text-muted">
                                No projects added.
                            </p>
                        @endforelse
                    </div>
                </section>

            </div>
        </div>
    </div>

    <script>
        function copyResumeLink(link) {
            navigator.clipboard.writeText(link).then(function () {
                const message = document.getElementById('copy-message');
                message.classList.remove('hidden');

                setTimeout(function () {
                    message.classList.add('hidden');
                }, 2500);
            });
        }
    </script>
</x-app-layout>