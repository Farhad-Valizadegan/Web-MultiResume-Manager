<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.theme-init')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Protected Resume</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-canvas flex items-center justify-center px-4 py-8 antialiased">
    <div class="rf-theme-corner">@include('layouts.theme-switch')</div>

    <div class="w-full max-w-lg">

        <!-- Main Card -->
        <div class="bg-surface rounded-xl shadow-sm border border-blue-soft overflow-hidden">

            <!-- Header -->
            <div class="bg-linear-to-r from-slate-900 via-blue-900 to-indigo-900 text-white px-6 py-7 text-center">
                <div class="mx-auto w-14 h-14 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         class="w-7 h-7 text-white">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>

                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">
                    Protected Resume Access
                </h1>

                <p class="text-blue-100 mt-2 text-sm sm:text-base leading-relaxed">
                    This resume is protected. Please enter the password provided by the resume owner.
                </p>
            </div>

            <!-- Body -->
            <div class="p-6 sm:p-8">

                <!-- Resume Info -->
                <div class="mb-6 bg-surface-soft border border-line rounded-xl p-4">
                    <p class="text-sm text-muted font-semibold uppercase tracking-wide">
                        Resume
                    </p>

                    <h2 class="text-xl font-bold text-ink mt-1 wrap-break-word tracking-tight">
                        {{ $resume->title }}
                    </h2>

                    @if ($resume->job_position)
                        <p class="text-muted mt-2 wrap-break-word">
                            Target Position:
                            <span class="font-semibold text-ink">
                                {{ $resume->job_position }}
                            </span>
                        </p>
                    @endif

                    @if ($resume->user)
                        <p class="text-muted mt-2 wrap-break-word">
                            Owner:
                            <span class="font-semibold text-ink">
                                {{ ($resume->full_name ?: $resume->title) }}
                            </span>
                        </p>
                    @endif
                </div>

                <!-- Error Message -->
                @if (session('error'))
                    <div class="mb-5 p-4 bg-red-soft border border-red-soft text-red-strong rounded-xl font-semibold">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Validation Error -->
                @error('resume_password')
                    <div class="mb-5 p-4 bg-red-soft border border-red-soft text-red-strong rounded-xl font-semibold">
                        {{ $message }}
                    </div>
                @enderror

                <!-- Password Form -->
                <form method="POST" action="{{ route('public.resume.verify', $resume->public_link) }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="resume_password" class="block mb-2 font-bold text-ink">
                            Resume Password
                        </label>

                        <input id="resume_password"
                               type="password"
                               name="resume_password"
                               class="w-full border border-line rounded-md px-4 py-3 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Enter resume password"
                               required
                               autofocus>
                    </div>

                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-bold shadow-lg transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             class="w-5 h-5">
                            <path d="M5 12h14"></path>
                            <path d="M12 5l7 7-7 7"></path>
                        </svg>

                        Unlock Resume
                    </button>
                </form>

                <!-- Security Note -->
                <div class="mt-6 bg-blue-soft border border-blue-soft rounded-xl p-4">
                    <p class="text-sm text-blue-strong leading-relaxed">
                        This page protects the resume from unauthorized access. If you do not have the password, please contact the resume owner.
                    </p>
                </div>

            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-blue-100 text-sm mt-5">
            Secure public resume access
        </p>

    </div>

</body>
</html>