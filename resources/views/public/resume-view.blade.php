<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.theme-init')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $resume->title }}</title>
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
    $currentLocation = $profile?->address;

    $selectedTheme = $resume->theme ?? 'professional_blue';

    $themes = [
        'professional_blue' => [
            'page_background' => 'bg-[radial-gradient(circle_at_top_left,rgba(59,130,246,0.28),transparent_34%),radial-gradient(circle_at_top_right,rgba(14,165,233,0.18),transparent_30%),linear-gradient(135deg,#020617,#0f172a_45%,#172554)]',
            'header_background' => 'bg-slate-950',
            'header_overlay' => 'bg-[radial-gradient(circle_at_top_left,rgba(59,130,246,0.35),transparent_34%),radial-gradient(circle_at_bottom_right,rgba(20,184,166,0.18),transparent_28%)]',
            'badge_background' => 'bg-white/10',
            'badge_text' => 'text-blue-100',
            'accent_dot' => 'bg-emerald-400',
            'subtitle_text' => 'text-blue-100',
            'primary_button' => 'bg-white text-slate-950 hover:bg-blue-50',
            'secondary_button' => 'bg-blue-500 text-white hover:bg-blue-600',
            'body_background' => 'bg-slate-100',
            'section_background' => 'bg-white',
            'section_border' => 'border-slate-200',
            'main_heading' => 'text-slate-950',
            'muted_text' => 'text-slate-500',
            'card_background' => 'bg-slate-50',
            'summary_background' => 'bg-linear-to-br from-blue-50 via-white to-slate-50',
            'summary_border' => 'border-blue-100',
            'experience_border' => 'border-blue-600',
            'experience_company' => 'text-blue-700',
            'skill_card_background' => 'bg-linear-to-br from-white to-indigo-50',
            'skill_card_border' => 'border-indigo-100',
            'skill_badge_background' => 'bg-indigo-100',
            'skill_badge_text' => 'text-indigo-800',
            'skill_level_text' => 'text-indigo-600',
            'footer_text' => 'text-slate-300',
        ],

        'dark_modern' => [
            'page_background' => 'bg-[radial-gradient(circle_at_top_left,rgba(34,211,238,0.22),transparent_32%),radial-gradient(circle_at_bottom_right,rgba(148,163,184,0.18),transparent_30%),linear-gradient(135deg,#020617,#020617_45%,#0f172a)]',
            'header_background' => 'bg-black',
            'header_overlay' => 'bg-[radial-gradient(circle_at_top_left,rgba(34,211,238,0.28),transparent_34%),radial-gradient(circle_at_bottom_right,rgba(71,85,105,0.35),transparent_28%)]',
            'badge_background' => 'bg-cyan-400/10',
            'badge_text' => 'text-cyan-100',
            'accent_dot' => 'bg-cyan-300',
            'subtitle_text' => 'text-cyan-100',
            'primary_button' => 'bg-cyan-400 text-slate-950 hover:bg-cyan-300',
            'secondary_button' => 'bg-slate-800 text-white hover:bg-slate-700',
            'body_background' => 'bg-slate-950',
            'section_background' => 'bg-slate-900',
            'section_border' => 'border-slate-700',
            'main_heading' => 'text-white',
            'muted_text' => 'text-slate-400',
            'card_background' => 'bg-slate-800',
            'summary_background' => 'bg-linear-to-br from-slate-800 via-slate-900 to-slate-950',
            'summary_border' => 'border-slate-700',
            'experience_border' => 'border-cyan-400',
            'experience_company' => 'text-cyan-300',
            'skill_card_background' => 'bg-linear-to-br from-slate-800 to-slate-900',
            'skill_card_border' => 'border-slate-700',
            'skill_badge_background' => 'bg-cyan-400/10',
            'skill_badge_text' => 'text-cyan-100',
            'skill_level_text' => 'text-cyan-300',
            'footer_text' => 'text-slate-400',
        ],

        'minimal_light' => [
            'page_background' => 'bg-linear-to-br from-slate-100 via-white to-slate-200',
            'header_background' => 'bg-white',
            'header_overlay' => 'bg-[linear-gradient(135deg,rgba(15,23,42,0.04),rgba(148,163,184,0.12))]',
            'badge_background' => 'bg-slate-100',
            'badge_text' => 'text-slate-700',
            'accent_dot' => 'bg-slate-700',
            'subtitle_text' => 'text-slate-600',
            'primary_button' => 'bg-slate-900 text-white hover:bg-slate-800',
            'secondary_button' => 'bg-white text-slate-900 border border-slate-300 hover:bg-slate-100',
            'body_background' => 'bg-white',
            'section_background' => 'bg-white',
            'section_border' => 'border-slate-200',
            'main_heading' => 'text-slate-950',
            'muted_text' => 'text-slate-500',
            'card_background' => 'bg-slate-50',
            'summary_background' => 'bg-white',
            'summary_border' => 'border-slate-200',
            'experience_border' => 'border-slate-800',
            'experience_company' => 'text-slate-700',
            'skill_card_background' => 'bg-white',
            'skill_card_border' => 'border-slate-200',
            'skill_badge_background' => 'bg-slate-100',
            'skill_badge_text' => 'text-slate-800',
            'skill_level_text' => 'text-slate-500',
            'footer_text' => 'text-slate-600',
        ],
    ];

    $theme = $themes[$selectedTheme] ?? $themes['professional_blue'];

    $hasDownloadOption =
        $resume->download_resume_type === 'generated' ||
        $resume->download_resume_type === 'uploaded' ||
        $resume->download_resume_type === 'both';

    $canDownloadGenerated =
        $resume->download_resume_type === 'generated' ||
        $resume->download_resume_type === 'both';

    $canDownloadUploaded =
        (
            $resume->download_resume_type === 'uploaded' ||
            $resume->download_resume_type === 'both'
        ) &&
        $resume->uploaded_resume_file;

    $hasSocialLinks =
        $profile &&
        (
            $profile->linkedin ||
            $profile->github ||
            $profile->portfolio ||
            $profile->xing
        );

    $groupedSkills = $resume->skills->groupBy(function ($skill) {
        return $skill->skill_category ?: 'Other Skills';
    });

    $isDarkTheme = $selectedTheme === 'dark_modern';
    $isMinimalTheme = $selectedTheme === 'minimal_light';
@endphp

<body class="min-h-screen {{ $isDarkTheme ? 'bg-slate-950 text-slate-100' : 'bg-slate-950 text-slate-900' }} antialiased">
    <div class="rf-theme-corner">@include('layouts.theme-switch')</div>

    <div class="min-h-screen {{ $theme['page_background'] }} px-4 py-6 sm:px-6 sm:py-10 lg:px-10">

        <div class="mx-auto max-w-7xl">

            <!-- Resume Shell -->
            <div class="overflow-hidden rounded-2xl border {{ $isDarkTheme ? 'border-slate-700 bg-slate-900' : 'border-white/10 bg-white' }} shadow-2xl">

                <!-- Header -->
                <header class="relative overflow-hidden {{ $theme['header_background'] }} {{ $isMinimalTheme ? 'text-slate-950 border-b border-slate-200' : 'text-white' }}">
                    <div class="absolute inset-0 {{ $theme['header_overlay'] }}"></div>

                    <div class="relative px-5 py-8 sm:px-8 sm:py-10 lg:px-12 lg:py-12">
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:items-start">

                            <!-- Profile Photo / Initial -->
                            <div class="lg:col-span-2">
                                <div class="flex flex-col items-start gap-4">
                                    @if ($profile && $profile->profile_photo)
                                        <img src="{{ route('resume.files.show', [$resume, 'photo']) }}"
                                             alt="{{ ($resume->full_name ?: $resume->title) }}"
                                             class="h-36 w-36 rounded-2xl {{ $isMinimalTheme ? 'border border-slate-200' : 'border border-white/20' }} object-cover shadow-xl sm:h-40 sm:w-40">
                                    @else
                                        <div class="flex h-36 w-36 items-center justify-center rounded-2xl {{ $isMinimalTheme ? 'border border-slate-200 bg-slate-100' : 'border border-white/20 bg-white/10' }} shadow-xl sm:h-40 sm:w-40">
                                            <span class="text-5xl font-black {{ $isMinimalTheme ? 'text-slate-900' : 'text-white' }}">
                                                {{ strtoupper(substr(($resume->full_name ?: $resume->title), 0, 1)) }}
                                            </span>
                                        </div>
                                    @endif

                                    @if ($hasDownloadOption)
                                        <div class="flex w-36 flex-col gap-2 sm:w-40">
                                            @if ($canDownloadGenerated)
                                                <a href="{{ route('public.resume.download-generated-pdf', $resume->public_link) }}"
                                                   class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-center text-sm font-extrabold shadow-sm transition {{ $theme['primary_button'] }}">
                                                    Download Generated PDF
                                                </a>
                                            @endif

                                            @if ($canDownloadUploaded)
                                                <a href="{{ route('public.resume.download-uploaded-pdf', $resume->public_link) }}"
                                                   class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-center text-sm font-extrabold shadow-sm transition {{ $theme['secondary_button'] }}">
                                                    Download Uploaded PDF
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Main Identity -->
                            <div class="min-w-0 lg:col-span-6">
                                <div class="mb-5 inline-flex items-center gap-2 rounded-full border {{ $isMinimalTheme ? 'border-slate-200' : 'border-white/15' }} {{ $theme['badge_background'] }} px-4 py-1.5 text-sm font-bold {{ $theme['badge_text'] }}">
                                    <span class="h-2 w-2 rounded-full {{ $theme['accent_dot'] }}"></span>
                                    Online Professional Resume
                                </div>

                                <h1 class="wrap-break-word text-4xl font-black tracking-tight {{ $isMinimalTheme ? 'text-slate-950' : 'text-white' }} sm:text-5xl lg:text-6xl">
                                    {{ ($resume->full_name ?: $resume->title) }}
                                </h1>

                                <p class="mt-4 wrap-break-word text-xl font-semibold {{ $theme['subtitle_text'] }} sm:text-2xl">
                                    {{ $resume->job_position ?? $resume->title }}
                                </p>

                                @if ($hasSocialLinks)
                                    <div class="mt-7 flex flex-wrap gap-3">
                                        @if ($profile->linkedin)
                                            <a href="{{ $profile->linkedin }}"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="inline-flex items-center gap-2 rounded-lg border {{ $isMinimalTheme ? 'border-slate-200 bg-white text-slate-900 hover:bg-slate-100' : 'border-white/15 bg-white/10 text-white hover:bg-white/15' }} px-4 py-2 text-sm font-bold transition">
                                                <span class="font-black {{ $isMinimalTheme ? 'text-slate-900' : 'text-blue-200' }}">in</span>
                                                LinkedIn
                                            </a>
                                        @endif

                                        @if ($profile->github)
                                            <a href="{{ $profile->github }}"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="inline-flex items-center rounded-lg border {{ $isMinimalTheme ? 'border-slate-200 bg-white text-slate-900 hover:bg-slate-100' : 'border-white/15 bg-white/10 text-white hover:bg-white/15' }} px-4 py-2 text-sm font-bold transition">
                                                GitHub
                                            </a>
                                        @endif

                                        @if ($profile->portfolio)
                                            <a href="{{ $profile->portfolio }}"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="inline-flex items-center rounded-lg border {{ $isMinimalTheme ? 'border-slate-200 bg-white text-slate-900 hover:bg-slate-100' : 'border-white/15 bg-white/10 text-white hover:bg-white/15' }} px-4 py-2 text-sm font-bold transition">
                                                Portfolio
                                            </a>
                                        @endif

                                        @if ($profile->xing)
                                            <a href="{{ $profile->xing }}"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="inline-flex items-center rounded-lg border {{ $isMinimalTheme ? 'border-slate-200 bg-white text-slate-900 hover:bg-slate-100' : 'border-white/15 bg-white/10 text-white hover:bg-white/15' }} px-4 py-2 text-sm font-bold transition">
                                                Xing
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Contact Details -->
                            <div class="lg:col-span-4">
                                <div class="overflow-hidden rounded-2xl border {{ $isMinimalTheme ? 'border-slate-200 bg-white text-slate-900' : 'border-white/15 bg-white/10 text-white backdrop-blur-sm' }} shadow-xl">
                                    <div class="border-b {{ $isMinimalTheme ? 'border-slate-200' : 'border-white/10' }} px-5 py-4">
                                        <h2 class="text-sm font-black uppercase tracking-wider {{ $isMinimalTheme ? 'text-slate-700' : $theme['badge_text'] }}">
                                            Contact Details
                                        </h2>
                                    </div>

                                    <div class="divide-y {{ $isMinimalTheme ? 'divide-slate-200' : 'divide-white/10' }}">
                                        <div class="px-5 py-4">
                                            <p class="text-xs font-black uppercase tracking-wide {{ $isMinimalTheme ? 'text-slate-500' : $theme['badge_text'] }}">
                                                Email
                                            </p>

                                            <p class="mt-1 break-all font-semibold {{ $isMinimalTheme ? 'text-slate-900' : 'text-white' }}">
                                                {{ $resume->email }}
                                            </p>
                                        </div>

                                        @if ($profile && $profile->phone)
                                            <div class="px-5 py-4">
                                                <p class="text-xs font-black uppercase tracking-wide {{ $isMinimalTheme ? 'text-slate-500' : $theme['badge_text'] }}">
                                                    Phone
                                                </p>

                                                <p class="mt-1 wrap-break-word font-semibold {{ $isMinimalTheme ? 'text-slate-900' : 'text-white' }}">
                                                    {{ $profile->phone }}
                                                </p>
                                            </div>
                                        @endif

                                        @if ($currentLocation)
                                            <div class="px-5 py-4">
                                                <p class="text-xs font-black uppercase tracking-wide {{ $isMinimalTheme ? 'text-slate-500' : $theme['badge_text'] }}">
                                                    Current Location
                                                </p>

                                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($currentLocation) }}"
                                                   target="_blank"
                                                   rel="noopener noreferrer"
                                                   class="mt-1 inline-block wrap-break-word font-semibold underline underline-offset-4 transition {{ $isMinimalTheme ? 'text-slate-900 hover:text-slate-600' : 'text-white hover:text-blue-200' }}">
                                                    {{ $currentLocation }}
                                                </a>
                                            </div>
                                        @endif

                                        @if ($profile && $profile->website)
                                            <div class="px-5 py-4">
                                                <p class="text-xs font-black uppercase tracking-wide {{ $isMinimalTheme ? 'text-slate-500' : $theme['badge_text'] }}">
                                                    Website
                                                </p>

                                                <a href="{{ $profile->website }}"
                                                   target="_blank"
                                                   rel="noopener noreferrer"
                                                   class="mt-1 inline-block break-all font-semibold underline underline-offset-4 transition {{ $isMinimalTheme ? 'text-slate-900 hover:text-slate-600' : 'text-white hover:text-blue-200' }}">
                                                    {{ $profile->website }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </header>

                <!-- Body -->
                <main class="{{ $theme['body_background'] }} px-4 py-5 sm:px-6 sm:py-8 lg:px-10 lg:py-10">

                    <div class="grid grid-cols-1 gap-6 xl:grid-cols-12">

                        <!-- Main Column -->
                        <div class="space-y-6 xl:col-span-8">

                            <!-- Professional Summary -->
                            <section class="rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                <div class="mb-5 flex items-start justify-between gap-4">
                                    <div>
                                        <h2 class="text-2xl font-black {{ $theme['main_heading'] }}">
                                            Professional Summary
                                        </h2>

                                        <p class="mt-1 text-sm font-medium {{ $theme['muted_text'] }}">
                                            Brief professional overview
                                        </p>
                                    </div>

                                    <span class="hidden rounded-full {{ $isDarkTheme ? 'bg-cyan-400/10 text-cyan-100' : 'bg-blue-50 text-blue-700' }} px-3 py-1 text-xs font-black uppercase tracking-wide sm:inline-flex">
                                        Profile
                                    </span>
                                </div>

                                <div class="rounded-xl border {{ $theme['summary_border'] }} {{ $theme['summary_background'] }} p-5">
                                    <p class="wrap-break-word text-base leading-relaxed {{ $isDarkTheme ? 'text-slate-200' : 'text-slate-700' }} sm:text-lg">
                                        {{ $resume->title }}
                                    </p>

                                    @if ($profile && $profile->bio)
                                        <p class="mt-4 wrap-break-word leading-relaxed {{ $isDarkTheme ? 'text-slate-200' : 'text-slate-700' }}">
                                            {{ $profile->bio }}
                                        </p>
                                    @endif
                                </div>
                            </section>

                            <!-- Professional Experience -->
                            @if ($resume->experiences->count())
                                <section class="rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-black {{ $theme['main_heading'] }}">
                                            Professional Experience
                                        </h2>

                                        <p class="mt-1 text-sm font-medium {{ $theme['muted_text'] }}">
                                            Work history and responsibilities
                                        </p>
                                    </div>

                                    <div class="space-y-5">
                                        @foreach ($resume->experiences as $experience)
                                            <article class="rounded-xl border {{ $theme['section_border'] }} {{ $theme['card_background'] }} p-5">
                                                <div class="border-l-4 {{ $theme['experience_border'] }} pl-4">
                                                    @if ($experience->job_title)
                                                        <h3 class="wrap-break-word text-xl font-black {{ $theme['main_heading'] }}">
                                                            {{ $experience->job_title }}
                                                        </h3>
                                                    @endif

                                                    @if ($experience->company_name)
                                                        <p class="mt-1 wrap-break-word font-extrabold {{ $theme['experience_company'] }}">
                                                            {{ $experience->company_name }}
                                                        </p>
                                                    @endif

                                                    @if ($experience->start_date || $experience->end_date)
                                                        <p class="mt-3 inline-block rounded-full {{ $isDarkTheme ? 'bg-slate-700 text-slate-200' : 'bg-white text-slate-600' }} px-3 py-1 text-sm font-bold shadow-xs">
                                                            @if ($experience->start_date && $experience->end_date)
                                                                {{ $experience->start_date }} - {{ $experience->end_date }}
                                                            @elseif ($experience->start_date && !$experience->end_date)
                                                                {{ $experience->start_date }} - Present
                                                            @elseif (!$experience->start_date && $experience->end_date)
                                                                Until {{ $experience->end_date }}
                                                            @endif
                                                        </p>
                                                    @endif

                                                    @if ($experience->description)
                                                        <p class="mt-4 wrap-break-word leading-relaxed {{ $isDarkTheme ? 'text-slate-300' : 'text-slate-700' }}">
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
                                <section class="rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-black {{ $theme['main_heading'] }}">
                                            Projects
                                        </h2>

                                        <p class="mt-1 text-sm font-medium {{ $theme['muted_text'] }}">
                                            Portfolio projects and practical work
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                        @foreach ($resume->projects as $project)
                                            <article class="flex flex-col rounded-xl border {{ $isDarkTheme ? 'border-slate-700 bg-slate-800' : 'border-rose-100 bg-linear-to-br from-white to-rose-50' }} p-5 shadow-xs transition hover:shadow-md">
                                                <h3 class="wrap-break-word text-lg font-black {{ $theme['main_heading'] }}">
                                                    {{ $project->project_title }}
                                                </h3>

                                                @if ($project->project_description)
                                                    <p class="mt-3 flex-1 wrap-break-word leading-relaxed {{ $isDarkTheme ? 'text-slate-300' : 'text-slate-700' }}">
                                                        {{ $project->project_description }}
                                                    </p>
                                                @endif

                                                @if ($project->project_link)
                                                    <p class="mt-4">
                                                        <a href="{{ $project->project_link }}"
                                                           target="_blank"
                                                           rel="noopener noreferrer"
                                                           class="inline-flex rounded-lg {{ $isDarkTheme ? 'bg-cyan-500 text-slate-950 hover:bg-cyan-400' : 'bg-rose-600 text-white hover:bg-rose-700' }} px-4 py-2 text-sm font-extrabold transition">
                                                            View Project
                                                        </a>
                                                    </p>
                                                @endif
                                            </article>
                                        @endforeach
                                    </div>
                                </section>
                            @endif

                            <!-- Licenses & Certifications -->
                            @if ($resume->certificates->count())
                                <section class="rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-black {{ $theme['main_heading'] }}">
                                            Licenses & Certifications
                                        </h2>

                                        <p class="mt-1 text-sm font-medium {{ $theme['muted_text'] }}">
                                            Certificates, courses, and related evidence
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                        @foreach ($resume->certificates as $certificate)
                                            <article class="flex flex-col rounded-xl border {{ $isDarkTheme ? 'border-slate-700 bg-slate-800' : 'border-amber-100 bg-linear-to-br from-white to-amber-50' }} p-5 shadow-xs transition hover:shadow-md">
                                                <div class="flex-1">
                                                    <h3 class="wrap-break-word text-lg font-black {{ $theme['main_heading'] }}">
                                                        {{ $certificate->certificate_title }}
                                                    </h3>

                                                    @if ($certificate->issuer)
                                                        <p class="mt-1 wrap-break-word font-extrabold {{ $isDarkTheme ? 'text-amber-300' : 'text-amber-700' }}">
                                                            {{ $certificate->issuer }}
                                                        </p>
                                                    @endif

                                                    @if ($certificate->issue_date || $certificate->credential_id)
                                                        <div class="mt-3 space-y-1 wrap-break-word text-sm font-medium {{ $theme['muted_text'] }}">
                                                            @if ($certificate->issue_date)
                                                                <p>Issued: {{ $certificate->issue_date }}</p>
                                                            @endif

                                                            @if ($certificate->credential_id)
                                                                <p>Credential ID: {{ $certificate->credential_id }}</p>
                                                            @endif
                                                        </div>
                                                    @endif

                                                    @if ($certificate->description)
                                                        <p class="mt-3 wrap-break-word leading-relaxed {{ $isDarkTheme ? 'text-slate-300' : 'text-slate-700' }}">
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
                                                        <p class="mb-2 text-sm font-black {{ $isDarkTheme ? 'text-slate-200' : 'text-slate-800' }}">
                                                            Certificate File
                                                        </p>

                                                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                                                            <a href="{{ $certificateFileUrl }}"
                                                               target="_blank"
                                                               rel="noopener noreferrer"
                                                               class="block">
                                                                <div class="rounded-lg border {{ $isDarkTheme ? 'border-slate-700 bg-slate-900 hover:border-slate-500' : 'border-amber-100 bg-white hover:border-amber-300' }} p-2 transition">
                                                                    <img src="{{ $certificateFileUrl }}"
                                                                         alt="{{ $certificate->certificate_title }}"
                                                                         class="h-44 w-full rounded-md object-contain">
                                                                </div>
                                                            </a>
                                                        @elseif ($extension === 'pdf')
                                                            <div class="rounded-lg border {{ $isDarkTheme ? 'border-slate-700 bg-slate-900' : 'border-amber-100 bg-white' }} p-3">
                                                                <p class="wrap-break-word text-sm font-medium {{ $isDarkTheme ? 'text-slate-300' : 'text-slate-700' }}">
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
                                                               class="inline-flex items-center justify-center rounded-lg {{ $isDarkTheme ? 'bg-cyan-500 text-slate-950 hover:bg-cyan-400' : 'bg-blue-600 text-white hover:bg-blue-700' }} px-3 py-2 text-sm font-extrabold transition">
                                                                View Credential
                                                            </a>
                                                        @endif

                                                        @if ($certificate->certificate_file)
                                                            <a href="{{ route('resume.files.show', [$resume, 'certificate', $certificate->id]) }}"
                                                               target="_blank"
                                                               rel="noopener noreferrer"
                                                               class="inline-flex items-center justify-center rounded-lg {{ $isDarkTheme ? 'bg-slate-700 text-white hover:bg-slate-600' : 'bg-slate-900 text-white hover:bg-slate-800' }} px-3 py-2 text-sm font-extrabold transition">
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
                                <section class="rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-black {{ $theme['main_heading'] }}">
                                            Skills
                                        </h2>

                                        <p class="mt-1 text-sm font-medium {{ $theme['muted_text'] }}">
                                            Technical skills grouped by category
                                        </p>
                                    </div>

                                    @if ($resume->skill_display_style === 'compact')
                                        <div class="overflow-hidden rounded-xl border {{ $theme['section_border'] }}">
                                            @foreach ($groupedSkills as $category => $skills)
                                                <div class="{{ $isDarkTheme ? ($loop->odd ? 'bg-slate-800' : 'bg-slate-900') : ($loop->odd ? 'bg-slate-50' : 'bg-white') }} px-4 py-3">
                                                    <p class="mb-1 font-black {{ $theme['main_heading'] }}">
                                                        {{ $category }}
                                                    </p>

                                                    <p class="wrap-break-word text-sm leading-relaxed {{ $isDarkTheme ? 'text-slate-300' : 'text-slate-700' }}">
                                                        @foreach ($skills as $skill)
                                                            <span class="font-semibold {{ $isDarkTheme ? 'text-white' : 'text-slate-900' }}">
                                                                {{ $skill->skill_name }}
                                                            </span>

                                                            @if ($skill->skill_level)
                                                                <span class="{{ $theme['muted_text'] }}">
                                                                    ({{ $skill->skill_level }})
                                                                </span>
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
                                                    <h3 class="mb-3 wrap-break-word font-black {{ $theme['main_heading'] }}">
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
                                <section class="rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-black {{ $theme['main_heading'] }}">
                                            Education
                                        </h2>

                                        <p class="mt-1 text-sm font-medium {{ $theme['muted_text'] }}">
                                            Academic background
                                        </p>
                                    </div>

                                    <div class="space-y-4">
                                        @foreach ($resume->educations as $education)
                                            <article class="rounded-xl border {{ $isDarkTheme ? 'border-slate-700 bg-slate-800' : 'border-cyan-100 bg-linear-to-br from-white to-cyan-50' }} p-5 shadow-xs">
                                                @if ($education->institution_name)
                                                    <h3 class="wrap-break-word text-lg font-black {{ $theme['main_heading'] }}">
                                                        {{ $education->institution_name }}
                                                    </h3>
                                                @endif

                                                @if ($education->degree || $education->field_of_study)
                                                    <p class="mt-2 wrap-break-word font-semibold {{ $isDarkTheme ? 'text-slate-300' : 'text-slate-700' }}">
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
                                                    <p class="mt-3 inline-block rounded-full {{ $isDarkTheme ? 'bg-cyan-400/10 text-cyan-100' : 'bg-cyan-100 text-cyan-800' }} px-3 py-1 text-sm font-bold">
                                                        @if ($education->start_date && $education->end_date)
                                                            {{ $education->start_date }} - {{ $education->end_date }}
                                                        @elseif ($education->start_date && !$education->end_date)
                                                            {{ $education->start_date }} - Present
                                                        @elseif (!$education->start_date && $education->end_date)
                                                            Until {{ $education->end_date }}
                                                        @endif
                                                    </p>
                                                @endif

                                                @if ($education->description)
                                                    <p class="mt-4 wrap-break-word leading-relaxed {{ $isDarkTheme ? 'text-slate-300' : 'text-slate-700' }}">
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
                                <section class="rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-black {{ $theme['main_heading'] }}">
                                            Languages
                                        </h2>

                                        <p class="mt-1 text-sm font-medium {{ $theme['muted_text'] }}">
                                            Language proficiency
                                        </p>
                                    </div>

                                    <div class="space-y-3">
                                        @foreach ($resume->languages as $language)
                                            <div class="flex items-center justify-between gap-4 rounded-xl border {{ $isDarkTheme ? 'border-slate-700 bg-slate-800' : 'border-purple-100 bg-linear-to-br from-white to-purple-50' }} p-4">
                                                <h3 class="wrap-break-word font-black {{ $theme['main_heading'] }}">
                                                    {{ $language->language_name }}
                                                </h3>

                                                @if ($language->proficiency_level)
                                                    <span class="shrink-0 rounded-full {{ $isDarkTheme ? 'bg-purple-400/10 text-purple-100' : 'bg-purple-100 text-purple-800' }} px-3 py-1 text-sm font-bold">
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
                                <section class="rounded-2xl border {{ $theme['section_border'] }} {{ $theme['section_background'] }} p-5 shadow-xs sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-black {{ $theme['main_heading'] }}">
                                            Hobbies & Interests
                                        </h2>

                                        <p class="mt-1 text-sm font-medium {{ $theme['muted_text'] }}">
                                            Personal interests and professional motivation
                                        </p>
                                    </div>

                                    <div class="space-y-4">
                                        @foreach ($resume->interests as $interest)
                                            <article class="rounded-xl border {{ $isDarkTheme ? 'border-slate-700 bg-slate-800' : 'border-teal-100 bg-linear-to-br from-white to-teal-50' }} p-5 shadow-xs">
                                                <h3 class="wrap-break-word text-lg font-black {{ $theme['main_heading'] }}">
                                                    {{ $interest->interest_name }}
                                                </h3>

                                                @if ($interest->description)
                                                    <p class="mt-3 wrap-break-word leading-relaxed {{ $isDarkTheme ? 'text-slate-300' : 'text-slate-700' }}">
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
            </div>

            <p class="mt-6 px-4 text-center text-sm font-medium {{ $theme['footer_text'] }}">
                This resume is shared through a protected public link.
            </p>

        </div>
    </div>

</body>
</html>