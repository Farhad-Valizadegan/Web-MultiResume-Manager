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
            <div class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-blue-950 to-indigo-900 text-white">
                <div class="absolute inset-0 opacity-20">
                    <div class="absolute -top-24 -right-24 w-72 h-72 bg-blue-400 rounded-md blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-72 h-72 bg-indigo-500 rounded-md blur-3xl"></div>
                </div>

                <div class="relative px-5 sm:px-8 lg:px-12 py-7 sm:py-10">
                    <div class="max-w-6xl">

                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-white/10 border border-white/20 text-blue-100 text-sm mb-6">
                            <span class="w-2 h-2 rounded-sm bg-emerald-400"></span>
                            Online Professional Resume
                        </div>

                        <!-- Name and Photo -->
                        <div class="flex flex-col sm:flex-row sm:items-center gap-5">
                            @if ($resume->user->profile && $resume->user->profile->profile_photo)
                                <div class="shrink-0">
                                    <img src="{{ asset('storage/' . $resume->user->profile->profile_photo) }}"
                                         alt="{{ $resume->user->name }}"
                                         class="w-28 h-28 sm:w-32 sm:h-32 rounded-lg object-cover border-4 border-white/30 shadow-2xl">
                                </div>
                            @else
                                <div class="shrink-0 w-28 h-28 sm:w-32 sm:h-32 rounded-lg bg-white/10 border-4 border-white/20 shadow-2xl flex items-center justify-center">
                                    <span class="text-3xl font-extrabold text-white">
                                        {{ strtoupper(substr($resume->user->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif

                            <div class="min-w-0">
                                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight break-words">
                                    {{ $resume->user->name }}
                                </h1>

                                <p class="text-base sm:text-lg lg:text-xl text-blue-100 mt-4 break-words font-medium">
                                    {{ $resume->job_position ?? $resume->title }}
                                </p>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 text-sm">
                            <div class="bg-white/10 border border-white/15 rounded-lg p-3 backdrop-blur">
                                <p class="text-blue-100 text-xs uppercase tracking-wide">Email</p>
                                <p class="break-all font-medium">{{ $resume->user->email }}</p>
                            </div>

                            @if ($resume->user->profile && $resume->user->profile->phone)
                                <div class="bg-white/10 border border-white/15 rounded-lg p-3 backdrop-blur">
                                    <p class="text-blue-100 text-xs uppercase tracking-wide">Phone</p>
                                    <p class="break-words font-medium">{{ $resume->user->profile->phone }}</p>
                                </div>
                            @endif

                            @if ($resume->user->profile && $resume->user->profile->address)
                                <div class="bg-white/10 border border-white/15 rounded-lg p-3 backdrop-blur">
                                    <p class="text-blue-100 text-xs uppercase tracking-wide">Location</p>
                                    <p class="break-words font-medium">{{ $resume->user->profile->address }}</p>
                                </div>
                            @endif

                            @if ($resume->user->profile && $resume->user->profile->website)
                                <div class="bg-white/10 border border-white/15 rounded-lg p-3 backdrop-blur">
                                    <p class="text-blue-100 text-xs uppercase tracking-wide">Website</p>
                                    <a href="{{ $resume->user->profile->website }}"
                                       target="_blank"
                                       class="break-all font-medium text-white hover:text-blue-200 underline underline-offset-4">
                                        {{ $resume->user->profile->website }}
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Social Links -->
                        @if (
                            $resume->user->profile &&
                            (
                                $resume->user->profile->linkedin ||
                                $resume->user->profile->github ||
                                $resume->user->profile->portfolio ||
                                $resume->user->profile->xing
                            )
                        )
                            <div class="mt-5 flex flex-wrap gap-3">

                                @if ($resume->user->profile->linkedin)
                                    <a href="{{ $resume->user->profile->linkedin }}"
                                       target="_blank"
                                       class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-white text-blue-900 hover:bg-blue-50 border border-white/30 shadow-md text-sm font-bold transition">
                                        LinkedIn
                                    </a>
                                @endif

                                @if ($resume->user->profile->github)
                                    <a href="{{ $resume->user->profile->github }}"
                                       target="_blank"
                                       class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-white text-slate-900 hover:bg-slate-100 border border-white/30 shadow-md text-sm font-bold transition">
                                        GitHub
                                    </a>
                                @endif

                                @if ($resume->user->profile->portfolio)
                                    <a href="{{ $resume->user->profile->portfolio }}"
                                       target="_blank"
                                       class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-white text-indigo-900 hover:bg-indigo-50 border border-white/30 shadow-md text-sm font-bold transition">
                                        Portfolio
                                    </a>
                                @endif

                                @if ($resume->user->profile->xing)
                                    <a href="{{ $resume->user->profile->xing }}"
                                       target="_blank"
                                       class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-white text-emerald-900 hover:bg-emerald-50 border border-white/30 shadow-md text-sm font-bold transition">
                                        Xing
                                    </a>
                                @endif

                            </div>
                        @endif

                        <!-- Download Buttons -->
                        @if (
                            $resume->download_resume_type === 'generated' ||
                            $resume->download_resume_type === 'uploaded' ||
                            $resume->download_resume_type === 'both'
                        )
                            <div class="mt-6 flex flex-wrap gap-3">

                                @if ($resume->download_resume_type === 'generated' || $resume->download_resume_type === 'both')
                                    <a href="{{ route('public.resume.download-generated-pdf', $resume->public_link) }}"
                                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-md bg-emerald-500 text-white hover:bg-emerald-600 shadow-lg text-sm font-extrabold transition">
                                        Download Generated PDF
                                    </a>
                                @endif

                                @if (
                                    ($resume->download_resume_type === 'uploaded' || $resume->download_resume_type === 'both') &&
                                    $resume->uploaded_resume_file
                                )
                                    <a href="{{ route('public.resume.download-uploaded-pdf', $resume->public_link) }}"
                                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-md bg-white text-slate-900 hover:bg-slate-100 shadow-lg text-sm font-extrabold transition">
                                        Download Uploaded PDF
                                    </a>
                                @endif

                            </div>
                        @endif

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
                                Grouped technical and professional skills
                            </p>
                        </div>

                        @php
                            $groupedSkills = $resume->skills->groupBy(function ($skill) {
                                return $skill->skill_category ?: 'Other Skills';
                            });
                        @endphp

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                            @foreach ($groupedSkills as $category => $skills)
                                <div class="rounded-md border border-slate-200 bg-slate-50 p-5 shadow-sm hover:shadow-md transition">
                                    <h3 class="text-lg font-extrabold text-slate-900 mb-4 break-words">
                                        {{ $category }}
                                    </h3>

                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($skills as $skill)
                                            <span class="inline-flex items-center gap-1 bg-blue-50 border border-blue-100 text-blue-900 px-3 py-2 rounded-md text-sm">
                                                <span class="font-bold">{{ $skill->skill_name }}</span>

                                                @if ($skill->skill_level)
                                                    <span class="text-blue-600">• {{ $skill->skill_level }}</span>
                                                @endif
                                            </span>
                                        @endforeach
                                    </div>
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

            </main>
        </div>

        <p class="text-center text-slate-300 text-sm mt-6 px-4">
            This resume is shared through a protected public link.
        </p>

    </div>

</body>
</html>