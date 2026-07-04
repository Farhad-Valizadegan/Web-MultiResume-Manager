<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $resume->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-blue-950 text-slate-900 antialiased">

    <div class="w-full mx-auto py-6 sm:py-10 px-4 sm:px-6 lg:px-10 xl:px-16">

        <div class="max-w-7xl mx-auto overflow-hidden rounded-xl bg-white shadow-2xl border border-slate-300">

            <!-- Header -->
            <div class="bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 text-white">
                @php
                    $profile = $resume->user->profile;
                    $currentLocation = $profile?->address;
                @endphp

                <div class="px-6 sm:px-8 lg:px-12 py-8 sm:py-10">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                        <!-- Left: Photo and Download -->
                        <div class="lg:col-span-2 flex flex-col items-start gap-4">
                            @if ($profile && $profile->profile_photo)
                                <img src="{{ asset('storage/' . $profile->profile_photo) }}"
                                     alt="{{ $resume->user->name }}"
                                     class="w-36 h-36 sm:w-40 sm:h-40 rounded-lg object-cover border border-white/20 shadow-lg">
                            @else
                                <div class="w-36 h-36 sm:w-40 sm:h-40 rounded-lg bg-white/10 border border-white/20 shadow-lg flex items-center justify-center">
                                    <span class="text-5xl font-extrabold text-white">
                                        {{ strtoupper(substr($resume->user->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif

                            @if (
                                $resume->download_resume_type === 'generated' ||
                                $resume->download_resume_type === 'uploaded' ||
                                $resume->download_resume_type === 'both'
                            )
                                <div class="flex flex-col gap-2 w-36 sm:w-40">

                                    @if ($resume->download_resume_type === 'generated' || $resume->download_resume_type === 'both')
                                        <a href="{{ route('public.resume.download-generated-pdf', $resume->public_link) }}"
                                           class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-white text-slate-950 hover:bg-slate-100 shadow text-sm font-bold transition">
                                            Download PDF
                                        </a>
                                    @endif

                                    @if (
                                        ($resume->download_resume_type === 'uploaded' || $resume->download_resume_type === 'both') &&
                                        $resume->uploaded_resume_file
                                    )
                                        <a href="{{ route('public.resume.download-uploaded-pdf', $resume->public_link) }}"
                                           class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-white text-slate-950 hover:bg-slate-100 shadow text-sm font-bold transition">
                                            Download PDF
                                        </a>
                                    @endif

                                </div>
                            @endif
                        </div>

                        <!-- Middle: Name and Title -->
                        <div class="lg:col-span-6 min-w-0 pt-2">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-white/10 border border-white/15 text-blue-100 text-sm mb-5">
                                <span class="w-2 h-2 rounded-sm bg-emerald-400"></span>
                                Online Professional Resume
                            </div>

                            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight break-words">
                                {{ $resume->user->name }}
                            </h1>

                            <p class="text-xl sm:text-2xl text-blue-100 mt-4 break-words font-medium">
                                {{ $resume->job_position ?? $resume->title }}
                            </p>

                            @if (
                                $profile &&
                                (
                                    $profile->linkedin ||
                                    $profile->github ||
                                    $profile->portfolio ||
                                    $profile->xing
                                )
                            )
                                <div class="mt-6 flex flex-wrap gap-3">

                                    @if ($profile->linkedin)
                                        <a href="{{ $profile->linkedin }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-white/5 hover:bg-white/10 border border-white/15 text-white text-sm font-bold transition">
                                            <span class="text-blue-200 font-extrabold">in</span>
                                            LinkedIn
                                        </a>
                                    @endif

                                    @if ($profile->github)
                                        <a href="{{ $profile->github }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-white/5 hover:bg-white/10 border border-white/15 text-white text-sm font-bold transition">
                                            GitHub
                                        </a>
                                    @endif

                                    @if ($profile->portfolio)
                                        <a href="{{ $profile->portfolio }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-white/5 hover:bg-white/10 border border-white/15 text-white text-sm font-bold transition">
                                            Portfolio
                                        </a>
                                    @endif

                                    @if ($profile->xing)
                                        <a href="{{ $profile->xing }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-white/5 hover:bg-white/10 border border-white/15 text-white text-sm font-bold transition">
                                            Xing
                                        </a>
                                    @endif

                                </div>
                            @endif
                        </div>

                        <!-- Right: Contact Box -->
                        <div class="lg:col-span-4">
                            <div class="rounded-lg bg-white/10 border border-white/15 shadow-lg overflow-hidden">
                                <div class="px-5 py-4 border-b border-white/10">
                                    <h2 class="text-sm font-extrabold uppercase tracking-wide text-blue-100">
                                        Contact Details
                                    </h2>
                                </div>

                                <div class="divide-y divide-white/10">

                                    <div class="px-5 py-4">
                                        <p class="text-xs uppercase tracking-wide text-blue-100 font-bold">
                                            Email
                                        </p>
                                        <p class="mt-1 text-white font-semibold break-all">
                                            {{ $resume->user->email }}
                                        </p>
                                    </div>

                                    @if ($profile && $profile->phone)
                                        <div class="px-5 py-4">
                                            <p class="text-xs uppercase tracking-wide text-blue-100 font-bold">
                                                Phone
                                            </p>
                                            <p class="mt-1 text-white font-semibold break-words">
                                                {{ $profile->phone }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($currentLocation)
                                        <div class="px-5 py-4">
                                            <p class="text-xs uppercase tracking-wide text-blue-100 font-bold">
                                                Current Location
                                            </p>
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($currentLocation) }}"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="mt-1 inline-block text-white hover:text-blue-200 font-semibold break-words underline underline-offset-4">
                                                {{ $currentLocation }}
                                            </a>
                                        </div>
                                    @endif

                                    @if ($profile && $profile->website)
                                        <div class="px-5 py-4">
                                            <p class="text-xs uppercase tracking-wide text-blue-100 font-bold">
                                                Website
                                            </p>
                                            <a href="{{ $profile->website }}"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="mt-1 inline-block text-white hover:text-blue-200 font-semibold break-all underline underline-offset-4">
                                                {{ $profile->website }}
                                            </a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Body -->
            <main class="p-5 sm:p-8 lg:p-12 space-y-6 bg-slate-200/90">

                <!-- Professional Summary -->
                <section class="rounded-lg border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
                    <div class="mb-5">
                        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900">
                            Professional Summary
                        </h2>

                        <p class="text-slate-500 text-sm mt-1">
                            Brief professional overview
                        </p>
                    </div>

                    <div class="rounded-md border border-blue-100 bg-gradient-to-br from-slate-50 to-blue-50 p-5 sm:p-6">
                        <p class="text-slate-700 text-base sm:text-lg leading-relaxed break-words">
                            {{ $resume->title }}
                        </p>

                        @if ($resume->user->profile && $resume->user->profile->bio)
                            <p class="text-slate-700 mt-4 leading-relaxed break-words">
                                {{ $resume->user->profile->bio }}
                            </p>
                        @endif
                    </div>
                </section>

                <!-- Skills -->
                @if ($resume->skills->count())
                    <section class="rounded-lg border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
                        <div class="mb-5">
                            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900">
                                Skills
                            </h2>

                            <p class="text-slate-500 text-sm mt-1">
                                Technical skills grouped by category
                            </p>
                        </div>

                        @php
                            $groupedSkills = $resume->skills->groupBy(function ($skill) {
                                return $skill->skill_category ?: 'Other Skills';
                            });
                        @endphp

                        @if ($resume->skill_display_style === 'compact')
                            <!-- Compact List Style -->
                            <div class="border border-slate-200 rounded-md overflow-hidden">
                                @foreach ($groupedSkills as $category => $skills)
                                    <div class="{{ $loop->odd ? 'bg-slate-100' : 'bg-white' }} px-4 py-2 text-sm sm:text-base leading-relaxed">
                                        <span class="font-extrabold text-slate-950">
                                            {{ $category }}:
                                        </span>

                                        <span class="text-slate-900">
                                            @foreach ($skills as $skill)
                                                {{ $skill->skill_name }}

                                                @if ($skill->skill_level)
                                                    <span class="text-slate-500">
                                                        ({{ $skill->skill_level }})
                                                    </span>
                                                @endif

                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- Card Style -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                                @foreach ($groupedSkills as $category => $skills)
                                    <div class="rounded-md border border-indigo-100 bg-gradient-to-br from-white to-indigo-50 p-5 shadow-sm hover:shadow-md transition">
                                        <h3 class="text-base font-extrabold text-slate-900 break-words mb-4">
                                            {{ $category }}
                                        </h3>

                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($skills as $skill)
                                                <span class="inline-flex flex-col px-3 py-2 rounded-md bg-indigo-100 text-indigo-800 text-sm font-semibold">
                                                    <span>
                                                        {{ $skill->skill_name }}
                                                    </span>

                                                    @if ($skill->skill_level)
                                                        <span class="text-xs text-indigo-600 font-medium mt-1">
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

                <!-- Professional Experience -->
                @if ($resume->experiences->count())
                    <section class="rounded-lg border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
                        <div class="mb-5">
                            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900">
                                Professional Experience
                            </h2>

                            <p class="text-slate-500 text-sm mt-1">
                                Work history and responsibilities
                            </p>
                        </div>

                        <div class="space-y-5">
                            @foreach ($resume->experiences as $experience)
                                <div class="rounded-md border border-slate-200 bg-slate-50 p-5 sm:p-6 shadow-sm">
                                    <div class="border-l-4 border-blue-600 pl-4">
                                        @if ($experience->job_title)
                                            <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 break-words">
                                                {{ $experience->job_title }}
                                            </h3>
                                        @endif

                                        @if ($experience->company_name)
                                            <p class="text-blue-700 font-bold mt-1 break-words">
                                                {{ $experience->company_name }}
                                            </p>
                                        @endif

                                        @if ($experience->start_date || $experience->end_date)
                                            <p class="inline-block bg-slate-100 text-slate-600 text-sm mt-3 px-3 py-1 rounded-md">
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
                                            <p class="text-slate-700 mt-4 leading-relaxed break-words">
                                                {{ $experience->description }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Education -->
                @if ($resume->educations->count())
                    <section class="rounded-lg border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
                        <div class="mb-5">
                            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900">
                                Education
                            </h2>

                            <p class="text-slate-500 text-sm mt-1">
                                Academic background
                            </p>
                        </div>

                        <div class="space-y-5">
                            @foreach ($resume->educations as $education)
                                <div class="rounded-md border border-cyan-100 bg-gradient-to-br from-white to-cyan-50 p-5 shadow-sm hover:shadow-md transition">
                                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">

                                        <div class="flex-1">
                                            @if ($education->institution_name)
                                                <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 break-words">
                                                    {{ $education->institution_name }}
                                                </h3>
                                            @endif

                                            @if ($education->degree || $education->field_of_study)
                                                <p class="text-slate-700 mt-2 break-words">
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

                                            @if ($education->description)
                                                <p class="text-slate-700 mt-4 leading-relaxed break-words">
                                                    {{ $education->description }}
                                                </p>
                                            @endif
                                        </div>

                                        @if ($education->start_date || $education->end_date)
                                            <div class="lg:shrink-0">
                                                <p class="inline-block bg-cyan-100 text-cyan-800 text-sm px-3 py-1 rounded-md">
                                                    @if ($education->start_date && $education->end_date)
                                                        {{ $education->start_date }} - {{ $education->end_date }}
                                                    @elseif ($education->start_date && !$education->end_date)
                                                        {{ $education->start_date }} - Present
                                                    @elseif (!$education->start_date && $education->end_date)
                                                        Until {{ $education->end_date }}
                                                    @endif
                                                </p>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Projects -->
                @if ($resume->projects->count())
                    <section class="rounded-lg border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
                        <div class="mb-5">
                            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900">
                                Projects
                            </h2>

                            <p class="text-slate-500 text-sm mt-1">
                                Portfolio projects and practical work
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            @foreach ($resume->projects as $project)
                                <div class="rounded-md border border-rose-100 bg-gradient-to-br from-white to-rose-50 p-5 shadow-sm hover:shadow-md transition">
                                    <h3 class="text-lg font-extrabold text-slate-900 break-words">
                                        {{ $project->project_title }}
                                    </h3>

                                    @if ($project->project_description)
                                        <p class="text-slate-700 mt-3 leading-relaxed break-words">
                                            {{ $project->project_description }}
                                        </p>
                                    @endif

                                    @if ($project->project_link)
                                        <p class="mt-4">
                                            <a href="{{ $project->project_link }}"
                                               class="inline-block px-4 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-700 font-semibold break-all"
                                               target="_blank">
                                                View Project
                                            </a>
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Licenses & Certifications -->
                @if ($resume->certificates->count())
                    <section class="rounded-lg border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
                        <div class="mb-5">
                            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900">
                                Licenses & Certifications
                            </h2>

                            <p class="text-slate-500 text-sm mt-1">
                                Certificates, courses, and related evidence
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                            @foreach ($resume->certificates as $certificate)
                                <div class="rounded-md border border-amber-100 bg-gradient-to-br from-white to-amber-50 p-5 shadow-sm hover:shadow-md transition flex flex-col">

                                    <div class="flex-1">
                                        <h3 class="text-lg font-extrabold text-slate-900 break-words">
                                            {{ $certificate->certificate_title }}
                                        </h3>

                                        @if ($certificate->issuer)
                                            <p class="text-amber-700 font-bold mt-1 break-words">
                                                {{ $certificate->issuer }}
                                            </p>
                                        @endif

                                        @if ($certificate->issue_date || $certificate->credential_id)
                                            <div class="text-slate-500 text-sm mt-3 space-y-1 break-words">
                                                @if ($certificate->issue_date)
                                                    <p>Issued: {{ $certificate->issue_date }}</p>
                                                @endif

                                                @if ($certificate->credential_id)
                                                    <p>Credential ID: {{ $certificate->credential_id }}</p>
                                                @endif
                                            </div>
                                        @endif

                                        @if ($certificate->description)
                                            <p class="text-slate-700 mt-3 leading-relaxed break-words">
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
                                            <p class="font-bold text-slate-800 text-sm mb-2">
                                                Certificate File
                                            </p>

                                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                                                <a href="{{ $certificateFileUrl }}" target="_blank" class="block">
                                                    <div class="bg-white border border-amber-100 rounded-md p-2 hover:border-amber-300 transition">
                                                        <img src="{{ $certificateFileUrl }}"
                                                             alt="{{ $certificate->certificate_title }}"
                                                             class="w-full h-44 object-contain rounded-sm">
                                                    </div>
                                                </a>
                                            @elseif ($extension === 'pdf')
                                                <div class="p-3 bg-white border border-amber-100 rounded-md">
                                                    <p class="text-slate-700 text-sm break-words">
                                                        PDF certificate uploaded.
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    @if ($certificate->credential_url || $certificate->certificate_file)
                                        <div class="mt-4 flex flex-col sm:flex-row gap-2">
                                            @if ($certificate->credential_url)
                                                <a href="{{ $certificate->credential_url }}"
                                                   target="_blank"
                                                   class="inline-flex items-center justify-center px-3 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 font-semibold transition">
                                                    View Credential
                                                </a>
                                            @endif

                                            @if ($certificate->certificate_file)
                                                <a href="{{ asset('storage/' . $certificate->certificate_file) }}"
                                                   target="_blank"
                                                   class="inline-flex items-center justify-center px-3 py-2 bg-slate-900 text-white text-sm rounded-md hover:bg-slate-800 font-semibold transition">
                                                    View File
                                                </a>
                                            @endif
                                        </div>
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Languages -->
                @if ($resume->languages->count())
                    <section class="rounded-lg border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
                        <div class="mb-5">
                            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900">
                                Languages
                            </h2>

                            <p class="text-slate-500 text-sm mt-1">
                                Language proficiency
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                            @foreach ($resume->languages as $language)
                                <div class="rounded-md border border-purple-100 bg-gradient-to-br from-white to-purple-50 p-5 shadow-sm">
                                    <h3 class="text-lg font-extrabold text-slate-900 break-words">
                                        {{ $language->language_name }}
                                    </h3>

                                    @if ($language->proficiency_level)
                                        <span class="inline-block mt-3 px-3 py-1 rounded-md bg-purple-100 text-purple-800 text-sm font-semibold">
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
                    <section class="rounded-lg border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
                        <div class="mb-5">
                            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900">
                                Hobbies & Interests
                            </h2>

                            <p class="text-slate-500 text-sm mt-1">
                                Personal interests and professional motivation
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                            @foreach ($resume->interests as $interest)
                                <div class="rounded-md border border-teal-100 bg-gradient-to-br from-white to-teal-50 p-5 shadow-sm hover:shadow-md transition">
                                    <h3 class="text-lg font-extrabold text-slate-900 break-words">
                                        {{ $interest->interest_name }}
                                    </h3>

                                    @if ($interest->description)
                                        <p class="text-slate-700 mt-3 leading-relaxed break-words">
                                            {{ $interest->description }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

            </main>
        </div>

        <p class="text-center text-slate-300 text-sm mt-6 px-4">
            This resume is shared through a protected public link.
        </p>

    </div>

</body>
</html>