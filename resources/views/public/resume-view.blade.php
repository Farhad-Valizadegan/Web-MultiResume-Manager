<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $resume->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-900 antialiased">

    @php
        $profile = $resume->user->profile;
        $currentLocation = $profile?->address;

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
    @endphp

    <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.28),_transparent_34%),radial-gradient(circle_at_top_right,_rgba(14,165,233,0.18),_transparent_30%),linear-gradient(135deg,_#020617,_#0f172a_45%,_#172554)] px-4 py-6 sm:px-6 sm:py-10 lg:px-10">

        <div class="mx-auto max-w-7xl">

            <!-- Resume Shell -->
            <div class="overflow-hidden rounded-2xl border border-white/10 bg-white shadow-2xl">

                <!-- Header -->
                <header class="relative overflow-hidden bg-slate-950 text-white">
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.35),_transparent_34%),radial-gradient(circle_at_bottom_right,_rgba(20,184,166,0.18),_transparent_28%)]"></div>

                    <div class="relative px-5 py-8 sm:px-8 sm:py-10 lg:px-12 lg:py-12">
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:items-start">

                            <!-- Profile Photo / Initial -->
                            <div class="lg:col-span-2">
                                <div class="flex flex-col items-start gap-4">
                                    @if ($profile && $profile->profile_photo)
                                        <img src="{{ asset('storage/' . $profile->profile_photo) }}"
                                             alt="{{ $resume->user->name }}"
                                             class="h-36 w-36 rounded-2xl border border-white/20 object-cover shadow-xl sm:h-40 sm:w-40">
                                    @else
                                        <div class="flex h-36 w-36 items-center justify-center rounded-2xl border border-white/20 bg-white/10 shadow-xl sm:h-40 sm:w-40">
                                            <span class="text-5xl font-black text-white">
                                                {{ strtoupper(substr($resume->user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                    @endif

                                    @if ($hasDownloadOption)
                                        <div class="flex w-36 flex-col gap-2 sm:w-40">
                                            @if ($canDownloadGenerated)
                                                <a href="{{ route('public.resume.download-generated-pdf', $resume->public_link) }}"
                                                   class="inline-flex items-center justify-center rounded-lg bg-white px-4 py-2 text-center text-sm font-extrabold text-slate-950 shadow transition hover:bg-blue-50">
                                                    Download Generated PDF
                                                </a>
                                            @endif

                                            @if ($canDownloadUploaded)
                                                <a href="{{ route('public.resume.download-uploaded-pdf', $resume->public_link) }}"
                                                   class="inline-flex items-center justify-center rounded-lg bg-blue-500 px-4 py-2 text-center text-sm font-extrabold text-white shadow transition hover:bg-blue-600">
                                                    Download Uploaded PDF
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Main Identity -->
                            <div class="min-w-0 lg:col-span-6">
                                <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-1.5 text-sm font-bold text-blue-100">
                                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                                    Online Professional Resume
                                </div>

                                <h1 class="break-words text-4xl font-black tracking-tight text-white sm:text-5xl lg:text-6xl">
                                    {{ $resume->user->name }}
                                </h1>

                                <p class="mt-4 break-words text-xl font-semibold text-blue-100 sm:text-2xl">
                                    {{ $resume->job_position ?? $resume->title }}
                                </p>

                                @if ($hasSocialLinks)
                                    <div class="mt-7 flex flex-wrap gap-3">
                                        @if ($profile->linkedin)
                                            <a href="{{ $profile->linkedin }}"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="inline-flex items-center gap-2 rounded-lg border border-white/15 bg-white/10 px-4 py-2 text-sm font-bold text-white transition hover:bg-white/15">
                                                <span class="font-black text-blue-200">in</span>
                                                LinkedIn
                                            </a>
                                        @endif

                                        @if ($profile->github)
                                            <a href="{{ $profile->github }}"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="inline-flex items-center rounded-lg border border-white/15 bg-white/10 px-4 py-2 text-sm font-bold text-white transition hover:bg-white/15">
                                                GitHub
                                            </a>
                                        @endif

                                        @if ($profile->portfolio)
                                            <a href="{{ $profile->portfolio }}"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="inline-flex items-center rounded-lg border border-white/15 bg-white/10 px-4 py-2 text-sm font-bold text-white transition hover:bg-white/15">
                                                Portfolio
                                            </a>
                                        @endif

                                        @if ($profile->xing)
                                            <a href="{{ $profile->xing }}"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="inline-flex items-center rounded-lg border border-white/15 bg-white/10 px-4 py-2 text-sm font-bold text-white transition hover:bg-white/15">
                                                Xing
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Contact Details -->
                            <div class="lg:col-span-4">
                                <div class="overflow-hidden rounded-2xl border border-white/15 bg-white/10 shadow-xl backdrop-blur">
                                    <div class="border-b border-white/10 px-5 py-4">
                                        <h2 class="text-sm font-black uppercase tracking-wider text-blue-100">
                                            Contact Details
                                        </h2>
                                    </div>

                                    <div class="divide-y divide-white/10">
                                        <div class="px-5 py-4">
                                            <p class="text-xs font-black uppercase tracking-wide text-blue-100">
                                                Email
                                            </p>

                                            <p class="mt-1 break-all font-semibold text-white">
                                                {{ $resume->user->email }}
                                            </p>
                                        </div>

                                        @if ($profile && $profile->phone)
                                            <div class="px-5 py-4">
                                                <p class="text-xs font-black uppercase tracking-wide text-blue-100">
                                                    Phone
                                                </p>

                                                <p class="mt-1 break-words font-semibold text-white">
                                                    {{ $profile->phone }}
                                                </p>
                                            </div>
                                        @endif

                                        @if ($currentLocation)
                                            <div class="px-5 py-4">
                                                <p class="text-xs font-black uppercase tracking-wide text-blue-100">
                                                    Current Location
                                                </p>

                                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($currentLocation) }}"
                                                   target="_blank"
                                                   rel="noopener noreferrer"
                                                   class="mt-1 inline-block break-words font-semibold text-white underline underline-offset-4 transition hover:text-blue-200">
                                                    {{ $currentLocation }}
                                                </a>
                                            </div>
                                        @endif

                                        @if ($profile && $profile->website)
                                            <div class="px-5 py-4">
                                                <p class="text-xs font-black uppercase tracking-wide text-blue-100">
                                                    Website
                                                </p>

                                                <a href="{{ $profile->website }}"
                                                   target="_blank"
                                                   rel="noopener noreferrer"
                                                   class="mt-1 inline-block break-all font-semibold text-white underline underline-offset-4 transition hover:text-blue-200">
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
                <main class="bg-slate-100 px-4 py-5 sm:px-6 sm:py-8 lg:px-10 lg:py-10">

                    <div class="grid grid-cols-1 gap-6 xl:grid-cols-12">

                        <!-- Main Column -->
                        <div class="space-y-6 xl:col-span-8">

                            <!-- Professional Summary -->
                            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                                <div class="mb-5 flex items-start justify-between gap-4">
                                    <div>
                                        <h2 class="text-2xl font-black text-slate-950">
                                            Professional Summary
                                        </h2>

                                        <p class="mt-1 text-sm font-medium text-slate-500">
                                            Brief professional overview
                                        </p>
                                    </div>

                                    <span class="hidden rounded-full bg-blue-50 px-3 py-1 text-xs font-black uppercase tracking-wide text-blue-700 sm:inline-flex">
                                        Profile
                                    </span>
                                </div>

                                <div class="rounded-xl border border-blue-100 bg-gradient-to-br from-blue-50 via-white to-slate-50 p-5">
                                    <p class="break-words text-base leading-relaxed text-slate-700 sm:text-lg">
                                        {{ $resume->title }}
                                    </p>

                                    @if ($profile && $profile->bio)
                                        <p class="mt-4 break-words leading-relaxed text-slate-700">
                                            {{ $profile->bio }}
                                        </p>
                                    @endif
                                </div>
                            </section>

                            <!-- Professional Experience -->
                            @if ($resume->experiences->count())
                                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-black text-slate-950">
                                            Professional Experience
                                        </h2>

                                        <p class="mt-1 text-sm font-medium text-slate-500">
                                            Work history and responsibilities
                                        </p>
                                    </div>

                                    <div class="space-y-5">
                                        @foreach ($resume->experiences as $experience)
                                            <article class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                                                <div class="border-l-4 border-blue-600 pl-4">
                                                    @if ($experience->job_title)
                                                        <h3 class="break-words text-xl font-black text-slate-950">
                                                            {{ $experience->job_title }}
                                                        </h3>
                                                    @endif

                                                    @if ($experience->company_name)
                                                        <p class="mt-1 break-words font-extrabold text-blue-700">
                                                            {{ $experience->company_name }}
                                                        </p>
                                                    @endif

                                                    @if ($experience->start_date || $experience->end_date)
                                                        <p class="mt-3 inline-block rounded-full bg-white px-3 py-1 text-sm font-bold text-slate-600 shadow-sm">
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
                                                        <p class="mt-4 break-words leading-relaxed text-slate-700">
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
                                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-black text-slate-950">
                                            Projects
                                        </h2>

                                        <p class="mt-1 text-sm font-medium text-slate-500">
                                            Portfolio projects and practical work
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                        @foreach ($resume->projects as $project)
                                            <article class="flex flex-col rounded-xl border border-rose-100 bg-gradient-to-br from-white to-rose-50 p-5 shadow-sm transition hover:shadow-md">
                                                <h3 class="break-words text-lg font-black text-slate-950">
                                                    {{ $project->project_title }}
                                                </h3>

                                                @if ($project->project_description)
                                                    <p class="mt-3 flex-1 break-words leading-relaxed text-slate-700">
                                                        {{ $project->project_description }}
                                                    </p>
                                                @endif

                                                @if ($project->project_link)
                                                    <p class="mt-4">
                                                        <a href="{{ $project->project_link }}"
                                                           target="_blank"
                                                           rel="noopener noreferrer"
                                                           class="inline-flex rounded-lg bg-rose-600 px-4 py-2 text-sm font-extrabold text-white transition hover:bg-rose-700">
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
                                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-black text-slate-950">
                                            Licenses & Certifications
                                        </h2>

                                        <p class="mt-1 text-sm font-medium text-slate-500">
                                            Certificates, courses, and related evidence
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                        @foreach ($resume->certificates as $certificate)
                                            <article class="flex flex-col rounded-xl border border-amber-100 bg-gradient-to-br from-white to-amber-50 p-5 shadow-sm transition hover:shadow-md">
                                                <div class="flex-1">
                                                    <h3 class="break-words text-lg font-black text-slate-950">
                                                        {{ $certificate->certificate_title }}
                                                    </h3>

                                                    @if ($certificate->issuer)
                                                        <p class="mt-1 break-words font-extrabold text-amber-700">
                                                            {{ $certificate->issuer }}
                                                        </p>
                                                    @endif

                                                    @if ($certificate->issue_date || $certificate->credential_id)
                                                        <div class="mt-3 space-y-1 break-words text-sm font-medium text-slate-500">
                                                            @if ($certificate->issue_date)
                                                                <p>Issued: {{ $certificate->issue_date }}</p>
                                                            @endif

                                                            @if ($certificate->credential_id)
                                                                <p>Credential ID: {{ $certificate->credential_id }}</p>
                                                            @endif
                                                        </div>
                                                    @endif

                                                    @if ($certificate->description)
                                                        <p class="mt-3 break-words leading-relaxed text-slate-700">
                                                            {{ $certificate->description }}
                                                        </p>
                                                    @endif
                                                </div>

                                                @if ($certificate->certificate_file)
                                                    @php
                                                        $extension = strtolower(pathinfo($certificate->certificate_file, PATHINFO_EXTENSION));
                                                        $certificateFileUrl = asset('storage/' . $certificate->certificate_file);
                                                    @endphp

                                                    <div class="mt-4">
                                                        <p class="mb-2 text-sm font-black text-slate-800">
                                                            Certificate File
                                                        </p>

                                                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                                                            <a href="{{ $certificateFileUrl }}"
                                                               target="_blank"
                                                               rel="noopener noreferrer"
                                                               class="block">
                                                                <div class="rounded-lg border border-amber-100 bg-white p-2 transition hover:border-amber-300">
                                                                    <img src="{{ $certificateFileUrl }}"
                                                                         alt="{{ $certificate->certificate_title }}"
                                                                         class="h-44 w-full rounded-md object-contain">
                                                                </div>
                                                            </a>
                                                        @elseif ($extension === 'pdf')
                                                            <div class="rounded-lg border border-amber-100 bg-white p-3">
                                                                <p class="break-words text-sm font-medium text-slate-700">
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
                                                               class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-3 py-2 text-sm font-extrabold text-white transition hover:bg-blue-700">
                                                                View Credential
                                                            </a>
                                                        @endif

                                                        @if ($certificate->certificate_file)
                                                            <a href="{{ asset('storage/' . $certificate->certificate_file) }}"
                                                               target="_blank"
                                                               rel="noopener noreferrer"
                                                               class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-3 py-2 text-sm font-extrabold text-white transition hover:bg-slate-800">
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
                                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-black text-slate-950">
                                            Skills
                                        </h2>

                                        <p class="mt-1 text-sm font-medium text-slate-500">
                                            Technical skills grouped by category
                                        </p>
                                    </div>

                                    @if ($resume->skill_display_style === 'compact')
                                        <div class="overflow-hidden rounded-xl border border-slate-200">
                                            @foreach ($groupedSkills as $category => $skills)
                                                <div class="{{ $loop->odd ? 'bg-slate-50' : 'bg-white' }} px-4 py-3">
                                                    <p class="mb-1 font-black text-slate-950">
                                                        {{ $category }}
                                                    </p>

                                                    <p class="break-words text-sm leading-relaxed text-slate-700">
                                                        @foreach ($skills as $skill)
                                                            <span class="font-semibold text-slate-900">
                                                                {{ $skill->skill_name }}
                                                            </span>

                                                            @if ($skill->skill_level)
                                                                <span class="text-slate-500">
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
                                                <div class="rounded-xl border border-indigo-100 bg-gradient-to-br from-white to-indigo-50 p-4 shadow-sm">
                                                    <h3 class="mb-3 break-words font-black text-slate-950">
                                                        {{ $category }}
                                                    </h3>

                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach ($skills as $skill)
                                                            <span class="inline-flex flex-col rounded-lg bg-indigo-100 px-3 py-2 text-sm font-bold text-indigo-800">
                                                                <span>
                                                                    {{ $skill->skill_name }}
                                                                </span>

                                                                @if ($skill->skill_level)
                                                                    <span class="mt-1 text-xs font-semibold text-indigo-600">
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
                                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-black text-slate-950">
                                            Education
                                        </h2>

                                        <p class="mt-1 text-sm font-medium text-slate-500">
                                            Academic background
                                        </p>
                                    </div>

                                    <div class="space-y-4">
                                        @foreach ($resume->educations as $education)
                                            <article class="rounded-xl border border-cyan-100 bg-gradient-to-br from-white to-cyan-50 p-5 shadow-sm">
                                                @if ($education->institution_name)
                                                    <h3 class="break-words text-lg font-black text-slate-950">
                                                        {{ $education->institution_name }}
                                                    </h3>
                                                @endif

                                                @if ($education->degree || $education->field_of_study)
                                                    <p class="mt-2 break-words font-semibold text-slate-700">
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
                                                    <p class="mt-3 inline-block rounded-full bg-cyan-100 px-3 py-1 text-sm font-bold text-cyan-800">
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
                                                    <p class="mt-4 break-words leading-relaxed text-slate-700">
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
                                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-black text-slate-950">
                                            Languages
                                        </h2>

                                        <p class="mt-1 text-sm font-medium text-slate-500">
                                            Language proficiency
                                        </p>
                                    </div>

                                    <div class="space-y-3">
                                        @foreach ($resume->languages as $language)
                                            <div class="flex items-center justify-between gap-4 rounded-xl border border-purple-100 bg-gradient-to-br from-white to-purple-50 p-4">
                                                <h3 class="break-words font-black text-slate-950">
                                                    {{ $language->language_name }}
                                                </h3>

                                                @if ($language->proficiency_level)
                                                    <span class="shrink-0 rounded-full bg-purple-100 px-3 py-1 text-sm font-bold text-purple-800">
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
                                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                                    <div class="mb-5">
                                        <h2 class="text-2xl font-black text-slate-950">
                                            Hobbies & Interests
                                        </h2>

                                        <p class="mt-1 text-sm font-medium text-slate-500">
                                            Personal interests and professional motivation
                                        </p>
                                    </div>

                                    <div class="space-y-4">
                                        @foreach ($resume->interests as $interest)
                                            <article class="rounded-xl border border-teal-100 bg-gradient-to-br from-white to-teal-50 p-5 shadow-sm">
                                                <h3 class="break-words text-lg font-black text-slate-950">
                                                    {{ $interest->interest_name }}
                                                </h3>

                                                @if ($interest->description)
                                                    <p class="mt-3 break-words leading-relaxed text-slate-700">
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

            <p class="mt-6 px-4 text-center text-sm font-medium text-slate-300">
                This resume is shared through a protected public link.
            </p>

        </div>
    </div>

</body>
</html>