<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.theme-init')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $resume->full_name ?: $resume->title }} · Resume</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    $profile = (object) [
        'address' => trim(implode(', ', array_filter([$resume->address, trim(($resume->postal_code ?? '') . ' ' . ($resume->city ?? '')), $resume->country]))),
        'phone' => $resume->phone, 'website' => $resume->website,
        'linkedin' => $resume->linkedin, 'github' => $resume->github,
        'portfolio' => null, 'xing' => null, 'profile_photo' => $resume->profile_photo,
        'bio' => $resume->professional_summary,
    ];
    $selectedTheme = in_array($resume->theme, ['professional_blue', 'dark_modern', 'minimal_light']) ? $resume->theme : 'professional_blue';
    $theme = [
        'body_background' => 'bg-surface', 'section_background' => 'bg-surface',
        'section_border' => 'border-line', 'main_heading' => 'text-ink', 'muted_text' => 'text-muted',
        'card_background' => 'bg-surface-soft', 'summary_background' => 'bg-surface-soft',
        'summary_border' => 'border-line', 'experience_border' => 'border-line',
        'experience_company' => 'pr-accent', 'skill_card_background' => 'bg-surface-soft',
        'skill_card_border' => 'border-line', 'skill_badge_background' => 'bg-surface-soft',
        'skill_badge_text' => 'text-ink', 'skill_level_text' => 'text-muted',
    ];
    $isDarkTheme = false;
    $groupedSkills = $resume->skills->groupBy(fn ($skill) => $skill->skill_category ?: 'Other Skills');
    $canDownloadGenerated = in_array($resume->download_resume_type, ['generated', 'both']);
    $canDownloadUploaded = in_array($resume->download_resume_type, ['uploaded', 'both']) && $resume->uploaded_resume_file;
    $sections = collect([
        'summary' => $profile->bio ? 'Overview' : null,
        'experience' => $resume->experiences->count() ? 'Experience' : null,
        'projects' => $resume->projects->count() ? 'Projects' : null,
        'certificates' => $resume->certificates->count() ? 'Certificates' : null,
        'skills' => $resume->skills->count() ? 'Skills' : null,
        'education' => $resume->educations->count() ? 'Education' : null,
        'languages' => $resume->languages->count() ? 'Languages' : null,
        'interests' => $resume->interests->count() ? 'Interests' : null,
    ])->filter();
@endphp
<body class="pr-page bg-canvas text-ink antialiased" data-resume-style="{{ $selectedTheme }}">
    <a href="#resume-content" class="rf-skip">Skip to resume content</a>
    <div class="pr-toolbar"><a href="#resume-top" class="pr-brand">ResumeFolio <span>Professional resume</span></a>@include('layouts.theme-switch')</div>
    <div class="pr-document" id="resume-top">
        <header class="pr-header">
            <div class="pr-identity">
                @if($profile->profile_photo)
                    <img src="{{ route('resume.files.show', [$resume, 'photo']) }}" alt="Portrait of {{ $resume->full_name ?: $resume->title }}" class="pr-photo" width="112" height="112">
                @else
                    <div class="pr-photo pr-initial" aria-hidden="true">{{ mb_strtoupper(mb_substr($resume->full_name ?: $resume->title, 0, 1)) }}</div>
                @endif
                <div class="min-w-0"><p class="pr-eyebrow">Professional profile</p><h1>{{ $resume->full_name ?: $resume->title }}</h1>@if($resume->job_position)<p class="pr-role">{{ $resume->job_position }}</p>@endif</div>
            </div>
            <address class="pr-contact">
                @if($resume->email)<a href="mailto:{{ $resume->email }}">{{ $resume->email }}</a>@endif
                @if($profile->phone)<a href="tel:{{ preg_replace('/[^0-9+]/', '', $profile->phone) }}">{{ $profile->phone }}</a>@endif
                @if($profile->address)
    <a href="https://www.google.com/maps/search/?api=1&amp;query={{ rawurlencode($profile->address) }}" target="_blank" rel="noopener noreferrer">
        {{ $profile->address }}
        <span aria-hidden="true">↗</span>
        <span class="sr-only"> (opens Google Maps in a new tab)</span>
    </a>
@endif
            </address>
            <div class="pr-header-actions">
                <div class="pr-social-links">
                    @foreach(['LinkedIn' => $profile->linkedin, 'GitHub' => $profile->github, 'Website' => $profile->website] as $label => $link)
                        @if($link)<a href="{{ $link }}" target="_blank" rel="noopener noreferrer">{{ $label }} <span aria-hidden="true">↗</span><span class="sr-only"> (opens in a new tab)</span></a>@endif
                    @endforeach
                </div>
                <div class="pr-downloads">
                    @if($canDownloadGenerated)<a href="{{ route('public.resume.download-generated-pdf', $resume->public_link) }}" class="rf-button rf-button-primary">Download resume <span class="pr-file-label">PDF</span></a>@endif
                    @if($canDownloadUploaded)<a href="{{ route('public.resume.download-uploaded-pdf', $resume->public_link) }}" class="rf-button rf-button-secondary">{{ $canDownloadGenerated ? 'Original resume PDF' : 'Download resume PDF' }}</a>@endif
                </div>
            </div>
        </header>
        @if($sections->count())<nav class="pr-section-nav" aria-label="Resume sections">@foreach($sections as $id => $label)<a href="#{{ $id }}">{{ $label }}</a>@endforeach</nav>@endif
        <main id="resume-content" tabindex="-1" class="pr-content {{ $theme['body_background'] }} px-4 py-5 sm:px-6 sm:py-8 lg:px-10 lg:py-10">

                    <div class="grid grid-cols-1 gap-6 xl:grid-cols-12">

                        <!-- Main Column -->
                        <div class="space-y-6 xl:col-span-8">

                            <!-- Professional Summary -->
@if($profile->bio)
<section id="summary" class="pr-section"><h2>Professional Summary</h2><p class="pr-summary whitespace-pre-line">{{ $profile->bio }}</p></section>
@endif

                            <!-- Professional Experience -->
                            @if ($resume->experiences->count())
                                <section id="experience" class="pr-section rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-semibold {{ $theme['main_heading'] }}">
                                            Professional Experience
                                        </h2>


                                    </div>

                                    <div class="space-y-5">
                                        @foreach ($resume->experiences as $experience)
                                            <article class="rounded-xl border {{ $theme['section_border'] }} {{ $theme['card_background'] }} p-5">
                                                <div class="border-l-4 {{ $theme['experience_border'] }} pl-4">
                                                    @if ($experience->job_title)
                                                        <h3 class="wrap-break-word text-xl font-semibold {{ $theme['main_heading'] }}">
                                                            {{ $experience->job_title }}
                                                        </h3>
                                                    @endif

                                                    @if ($experience->company_name)
                                                        <p class="mt-1 wrap-break-word font-semibold {{ $theme['experience_company'] }}">
                                                            {{ $experience->company_name }}
                                                        </p>
                                                    @endif

                                                    @if ($experience->start_date || $experience->end_date)
                                                        <p class="mt-3 inline-block rounded-full bg-surface text-muted px-3 py-1 text-sm font-bold shadow-xs">
                                                            @if ($experience->start_date && $experience->end_date)
                                                                {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} - {{ \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                                                            @elseif ($experience->start_date && !$experience->end_date)
                                                                {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} - Present
                                                            @elseif (!$experience->start_date && $experience->end_date)
                                                                Until {{ \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                                                            @endif
                                                        </p>
                                                    @endif

                                                    @if ($experience->description)
                                                        <p class="mt-4 wrap-break-word whitespace-pre-line leading-relaxed text-muted">
                                                            {{ $experience->description }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </article>
                                        @endforeach
                                    </div>
                                </section>
                            @endif

                            <!-- Projects -->
                            @if ($resume->projects->count())
                                <section id="projects" class="pr-section rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-semibold {{ $theme['main_heading'] }}">
                                            Projects
                                        </h2>


                                    </div>

                                    <div class="grid grid-cols-1 gap-5">
                                        @foreach ($resume->projects as $project)
                                            <article class="flex flex-col rounded-xl border border-line bg-surface-soft p-5 shadow-xs transition hover:shadow-md">
                                                <h3 class="wrap-break-word text-lg font-semibold {{ $theme['main_heading'] }}">
                                                    {{ $project->project_title }}
                                                </h3>

                                                @if ($project->project_description)
                                                    <p class="mt-3 flex-1 wrap-break-word whitespace-pre-line leading-relaxed text-muted">
                                                        {{ $project->project_description }}
                                                    </p>
                                                @endif

                                                <div class="mt-4 flex flex-wrap items-center gap-3">
@if ($project->project_link)
                                                    <p class="m-0">
                                                        <a href="{{ $project->project_link }}"
                                                           target="_blank"
                                                           rel="noopener noreferrer"
                                                           class="inline-flex rounded-lg bg-rose-600 text-white hover:bg-rose-700 px-4 py-2 text-sm font-semibold transition">
                                                            {{ $project->project_link_label ?: 'View Project' }}
                                                            <span aria-hidden="true">↗</span><span class="sr-only"> (opens in a new tab)</span>
                                                        </a>
                                                    </p>
                                                @endif
                                                @if ($project->demo_url)
                                                    <p class="m-0">
                                                        <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer"
                                                           class="rf-button rf-button-secondary">
                                                            {{ $project->demo_label ?: 'Watch demo' }}
                                                            <span aria-hidden="true">↗</span><span class="sr-only"> (opens in a new tab)</span>
                                                        </a>
                                                    </p>
                                                @endif
</div>
                                            </article>
                                        @endforeach
                                    </div>
                                </section>
                            @endif

                            <!-- Licenses & Certifications -->
                            @if ($resume->certificates->count())
                                <section id="certificates" class="pr-section rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-semibold {{ $theme['main_heading'] }}">
                                            Licenses & Certifications
                                        </h2>


                                    </div>

                                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                        @foreach ($resume->certificates as $certificate)
                                            <article class="flex flex-col rounded-xl border border-line bg-surface-soft p-5 shadow-xs transition hover:shadow-md">
                                                <div class="flex-1">
                                                    <h3 class="wrap-break-word text-lg font-semibold {{ $theme['main_heading'] }}">
                                                        {{ $certificate->certificate_title }}
                                                    </h3>

                                                    @if ($certificate->issuer)
                                                        <p class="mt-1 wrap-break-word font-semibold pr-accent">
                                                            {{ $certificate->issuer }}
                                                        </p>
                                                    @endif

                                                    @if ($certificate->issue_date || $certificate->credential_id)
                                                        <div class="mt-3 space-y-1 wrap-break-word text-sm font-medium {{ $theme['muted_text'] }}">
                                                            @if ($certificate->issue_date)
                                                                <p>Issued: {{ \Carbon\Carbon::parse($certificate->issue_date)->format('M Y') }}</p>
                                                            @endif

                                                            @if ($certificate->credential_id)
                                                                <p>Credential ID: {{ $certificate->credential_id }}</p>
                                                            @endif
                                                        </div>
                                                    @endif

                                                    @if ($certificate->description)
                                                        <p class="mt-3 wrap-break-word whitespace-pre-line leading-relaxed text-muted">
                                                            {{ $certificate->description }}
                                                        </p>
                                                    @endif
                                                </div>

                                                @if ($certificate->certificate_file)
                                                    @php
                                                        $extension = strtolower(pathinfo($certificate->certificate_file, PATHINFO_EXTENSION));
                                                        $certificateFileUrl = route('resume.files.show', [$resume, 'certificate', $certificate->id]);
                                                    @endphp

                                                    <div class="mt-4">
                                                        <p class="mb-2 text-sm font-semibold text-ink">
                                                            Certificate File
                                                        </p>

                                                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                                                            <a href="{{ $certificateFileUrl }}"
                                                               target="_blank"
                                                               rel="noopener noreferrer"
                                                               class="block">
                                                                <div class="rounded-lg border border-line bg-surface hover:border-amber-300 p-2 transition">
                                                                    <img loading="lazy" decoding="async" src="{{ $certificateFileUrl }}"
                                                                         alt="{{ $certificate->certificate_title }}"
                                                                         class="h-44 w-full rounded-md object-contain">
                                                                </div>
                                                            </a>
                                                        @elseif ($extension === 'pdf')
                                                            <div class="rounded-lg border border-line bg-surface p-3">
                                                                <p class="wrap-break-word text-sm font-medium text-muted">
                                                                    PDF certificate uploaded.
                                                                </p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif

                                                @if ($certificate->credential_url || $certificate->certificate_file)
                                                    <div class="mt-4 flex flex-col gap-2 sm:flex-row">
                                                        @if ($certificate->credential_url)
                                                            <a href="{{ $certificate->credential_url }}"
                                                               target="_blank"
                                                               rel="noopener noreferrer"
                                                               class="inline-flex items-center justify-center rounded-lg bg-blue-600 text-white hover:bg-blue-700 px-3 py-2 text-sm font-semibold transition">
                                                                View Credential
                                                            </a>
                                                        @endif

                                                        @if ($certificate->certificate_file)
                                                            <a href="{{ route('resume.files.show', [$resume, 'certificate', $certificate->id]) }}"
                                                               target="_blank"
                                                               rel="noopener noreferrer"
                                                               class="inline-flex items-center justify-center rounded-lg bg-slate-900 text-white hover:bg-slate-800 px-3 py-2 text-sm font-semibold transition">
                                                                View File
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endif
                                            </article>
                                        @endforeach
                                    </div>
                                </section>
                            @endif

                        </div>

                        <!-- Side Column -->
                        <aside class="space-y-6 xl:col-span-4">

                            <!-- Skills -->
                            @if ($resume->skills->count())
                                <section id="skills" class="pr-section rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-semibold {{ $theme['main_heading'] }}">
                                            Skills
                                        </h2>


                                    </div>

                                    @if ($resume->skill_display_style === 'compact')
                                        <div class="overflow-hidden rounded-xl border {{ $theme['section_border'] }}">
                                            @foreach ($groupedSkills as $category => $skills)
                                                <div class="{{ $isDarkTheme ? ($loop->odd ? 'bg-slate-800' : 'bg-slate-900') : ($loop->odd ? 'bg-surface-soft' : 'bg-surface') }} px-4 py-3">
                                                    <p class="mb-1 font-semibold {{ $theme['main_heading'] }}">
                                                        {{ $category }}
                                                    </p>

                                                    <p class="wrap-break-word text-sm leading-relaxed text-muted">
                                                        @foreach ($skills as $skill)
                                                            <span class="font-semibold text-ink">
                                                                {{ $skill->skill_name }}
                                                            </span>

                                                            @if ($skill->skill_level)
                                                                <span class="{{ $theme['muted_text'] }}">
                                                                    ({{ $skill->skill_level }})
                                                                </span>
                                                            @endif

                                                            @if($skill->evidence_url)
    <a href="{{ $skill->evidence_url }}" target="_blank" rel="noopener noreferrer" class="pr-accent underline underline-offset-4 inline-flex items-center min-h-11" aria-label="{{ $skill->evidence_label ?: 'View evidence' }} for {{ $skill->skill_name }} (opens in a new tab)">{{ $skill->evidence_label ?: 'View evidence' }} <span aria-hidden="true">↗</span></a>
@endif
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="space-y-4">
                                            @foreach ($groupedSkills as $category => $skills)
                                                <div class="rounded-xl border {{ $theme['skill_card_border'] }} {{ $theme['skill_card_background'] }} p-4 shadow-xs">
                                                    <h3 class="mb-3 wrap-break-word font-semibold {{ $theme['main_heading'] }}">
                                                        {{ $category }}
                                                    </h3>

                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach ($skills as $skill)
                                                            <span class="inline-flex flex-col rounded-lg {{ $theme['skill_badge_background'] }} px-3 py-2 text-sm font-bold {{ $theme['skill_badge_text'] }}">
                                                                <span>
                                                                    {{ $skill->skill_name }}
                                                                </span>

                                                                @if ($skill->skill_level)
                                                                    <span class="mt-1 text-xs font-semibold {{ $theme['skill_level_text'] }}">
                                                                        {{ $skill->skill_level }}
                                                                    </span>
                                                                @endif
                                                            @if($skill->evidence_url)
    <a href="{{ $skill->evidence_url }}" target="_blank" rel="noopener noreferrer" class="pr-accent underline underline-offset-4 inline-flex items-center min-h-11" aria-label="{{ $skill->evidence_label ?: 'View evidence' }} for {{ $skill->skill_name }} (opens in a new tab)">{{ $skill->evidence_label ?: 'View evidence' }} <span aria-hidden="true">↗</span></a>
@endif
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </section>
                            @endif

                            <!-- Education -->
                            @if ($resume->educations->count())
                                <section id="education" class="pr-section rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-semibold {{ $theme['main_heading'] }}">
                                            Education
                                        </h2>


                                    </div>

                                    <div class="space-y-4">
                                        @foreach ($resume->educations as $education)
                                            <article class="rounded-xl border border-line bg-surface-soft p-5 shadow-xs">
                                                @if ($education->institution_name)
                                                    <h3 class="wrap-break-word text-lg font-semibold {{ $theme['main_heading'] }}">
                                                        {{ $education->institution_name }}
                                                    </h3>
                                                @endif

                                                @if ($education->degree || $education->field_of_study)
                                                    <p class="mt-2 wrap-break-word font-semibold text-muted">
                                                        @if ($education->degree)
                                                            {{ $education->degree }}
                                                        @endif

                                                        @if ($education->degree && $education->field_of_study)
                                                            —
                                                        @endif

                                                        @if ($education->field_of_study)
                                                            {{ $education->field_of_study }}
                                                        @endif
                                                    </p>
                                                @endif

                                                @if ($education->start_date || $education->end_date)
                                                    <p class="mt-3 inline-block rounded-full bg-surface-soft pr-accent px-3 py-1 text-sm font-bold">
                                                        @if ($education->start_date && $education->end_date)
                                                            {{ \Carbon\Carbon::parse($education->start_date)->format('M Y') }} - {{ \Carbon\Carbon::parse($education->end_date)->format('M Y') }}
                                                        @elseif ($education->start_date && !$education->end_date)
                                                            {{ \Carbon\Carbon::parse($education->start_date)->format('M Y') }} - Present
                                                        @elseif (!$education->start_date && $education->end_date)
                                                            Until {{ \Carbon\Carbon::parse($education->end_date)->format('M Y') }}
                                                        @endif
                                                    </p>
                                                @endif

                                                @if ($education->description)
                                                    <p class="mt-4 wrap-break-word whitespace-pre-line leading-relaxed text-muted">
                                                        {{ $education->description }}
                                                    </p>
                                                @endif
                                            </article>
                                        @endforeach
                                    </div>
                                </section>
                            @endif

                            <!-- Languages -->
                            @if ($resume->languages->count())
                                <section id="languages" class="pr-section rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-semibold {{ $theme['main_heading'] }}">
                                            Languages
                                        </h2>


                                    </div>

                                    <div class="space-y-3">
                                        @foreach ($resume->languages as $language)
                                            <div class="flex items-center justify-between gap-4 rounded-xl border border-line bg-surface-soft p-4">
                                                <h3 class="wrap-break-word font-semibold {{ $theme['main_heading'] }}">
                                                    {{ $language->language_name }}
                                                </h3>

                                                @if ($language->proficiency_level)
                                                    <span class="shrink-0 rounded-full bg-surface-soft pr-accent px-3 py-1 text-sm font-bold">
                                                        {{ $language->proficiency_level }}
                                                    </span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            @endif

                            <!-- Hobbies & Interests -->
                            @if ($resume->interests->count())
                                <section id="interests" class="pr-section rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-semibold {{ $theme['main_heading'] }}">
                                            Hobbies & Interests
                                        </h2>


                                    </div>

                                    <div class="space-y-4">
                                        @foreach ($resume->interests as $interest)
                                            <article class="rounded-xl border border-line bg-surface-soft p-5 shadow-xs">
                                                <h3 class="wrap-break-word text-lg font-semibold {{ $theme['main_heading'] }}">
                                                    {{ $interest->interest_name }}
                                                </h3>

                                                @if ($interest->description)
                                                    <p class="mt-3 wrap-break-word whitespace-pre-line leading-relaxed text-muted">
                                                        {{ $interest->description }}
                                                    </p>
                                                @endif
                                            </article>
                                        @endforeach
                                    </div>
                                </section>
                            @endif

                        </aside>

                    </div>
                </main>
        <footer class="pr-footer"><p>{{ $resume->resume_password_hash ? 'Shared with password protection.' : 'Shared by the resume owner.' }}</p><a href="#resume-top">Back to top ↑</a></footer>
    </div>
</body>
</html>
