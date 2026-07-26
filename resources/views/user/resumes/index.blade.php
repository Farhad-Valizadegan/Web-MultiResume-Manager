<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    My Resumes
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Manage your resumes, public links, passwords, downloads, and view analytics.
                </p>
            </div>

            <a href="{{ route('user.resumes.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                Create New Resume
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-linear-to-br from-slate-900 via-slate-800 to-blue-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border-2 border-green-200 text-green-700 rounded-md font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div id="copy-message" class="hidden mb-4 p-4 bg-blue-100 border-2 border-blue-200 text-blue-700 rounded-md font-semibold">
                Public resume link copied successfully.
            </div>

            <div class="bg-slate-100 shadow-2xl sm:rounded-lg p-4 sm:p-6 border-2 border-slate-300">

                <!-- Page Intro -->
                <div class="mb-6 bg-white border-2 border-slate-300 rounded-lg p-5">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                        <div>
                            <h3 class="text-lg font-extrabold text-slate-900">
                                Resume List
                            </h3>

                            <p class="text-sm text-slate-600 mt-1">
                                Each resume has its own public link, password, download settings, and view counter.
                            </p>
                        </div>

                        <a href="{{ route('user.resumes.create') }}"
                           class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                            Create New Resume
                        </a>
                    </div>
                </div>

                @forelse ($resumes as $resume)
                    @php
                        $publicUrl = url('/resume/' . $resume->public_link);
                    @endphp

                    <div class="bg-white border-2 border-slate-300 rounded-lg p-4 sm:p-5 mb-5 shadow-xs hover:shadow-md transition">

                        <!-- Resume Header -->
                        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">

                            <div class="flex-1">
                                <h4 class="text-lg sm:text-xl font-extrabold text-slate-900 wrap-break-word">
                                    {{ $resume->title }}
                                </h4>

                                <p class="text-slate-600 mt-2 wrap-break-word">
                                    Job Position:
                                    <span class="font-semibold text-slate-800">
                                        {{ $resume->job_position ?? 'Not specified' }}
                                    </span>
                                </p>

                                <p class="text-slate-600 mt-2">
                                    Status:
                                    @if ($resume->status === 'active')
                                        <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-green-100 text-green-700">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-red-100 text-red-700">
                                            Inactive
                                        </span>
                                    @endif
                                </p>
                            </div>

                            <!-- View Counter Box -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 min-w-full lg:min-w-0 lg:w-auto">
                                <div class="bg-blue-50 border-2 border-blue-100 rounded-lg px-4 py-3">
                                    <p class="text-xs text-blue-600 font-bold uppercase tracking-wide">
                                        Views
                                    </p>

                                    <p class="text-2xl font-extrabold text-blue-700 mt-1">
                                        {{ $resume->view_count ?? 0 }}
                                    </p>
                                </div>

                                <div class="bg-slate-50 border-2 border-slate-200 rounded-lg px-4 py-3">
                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-wide">
                                        Last Viewed
                                    </p>

                                    <p class="text-sm font-bold text-slate-800 mt-2">
                                        @if ($resume->last_viewed_at)
                                            {{ $resume->last_viewed_at->format('Y-m-d H:i') }}
                                        @else
                                            Never viewed
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Public Link -->
                        <div class="mt-5 bg-slate-50 border border-slate-200 rounded-lg p-4">
                            <p class="text-slate-700 mb-2 font-bold">
                                Public Link
                            </p>

                            <div class="flex flex-col lg:flex-row lg:items-center gap-2">
                                <input type="text"
                                       value="{{ $publicUrl }}"
                                       readonly
                                       class="w-full lg:flex-1 border-2 border-slate-300 rounded-md shadow-xs font-mono text-sm px-3 py-2">

                                <button type="button"
                                        onclick="copyResumeLink('{{ $publicUrl }}')"
                                        class="w-full lg:w-auto whitespace-nowrap px-4 py-2 bg-slate-700 text-white rounded-md hover:bg-slate-800 font-semibold">
                                    Copy Link
                                </button>
                            </div>
                        </div>

                        <!-- Password and Access Info -->
                        <div class="mt-5 grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
                                <p class="text-slate-700 font-bold">
                                    Employer Password
                                </p>

                                @if ($resume->resume_password)
                                    <span class="font-mono bg-white border border-slate-300 px-2 py-1 rounded-md break-all inline-block mt-2">
                                        {{ $resume->resume_password }}
                                    </span>
                                @else
                                    <span class="text-red-600 font-semibold inline-block mt-2">
                                        No password set
                                    </span>
                                @endif
                            </div>

                            <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
                                <p class="text-slate-700 font-bold">
                                    Access Status
                                </p>

                                <p class="mt-2 text-slate-800 font-medium">
                                    @if ($resume->resume_password_hash)
                                        Password Required for Employer
                                    @else
                                        Public Without Password
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Download Type Info -->
                        <div class="mt-4 bg-slate-50 border border-slate-200 rounded-lg p-4">
                            <p class="text-slate-700 font-bold">
                                Download Option
                            </p>

                            <p class="mt-2 text-slate-800 font-medium">
                                @if ($resume->download_resume_type === 'generated')
                                    Generated Resume PDF only
                                @elseif ($resume->download_resume_type === 'uploaded')
                                    Uploaded Resume PDF only
                                @elseif ($resume->download_resume_type === 'both')
                                    Both Generated and Uploaded PDF
                                @else
                                    Not specified
                                @endif
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="mt-5 pt-5 border-t-2 border-slate-200 flex flex-col sm:flex-row sm:flex-wrap gap-3">
                            <a href="{{ $publicUrl }}"
                               target="_blank"
                               class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-green-600 text-white hover:bg-green-700 font-semibold">
                                View Public Resume
                            </a>

                            <a href="{{ route('user.resumes.edit', $resume) }}"
                               class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 font-semibold">
                                Edit
                            </a>

                            <a href="{{ route('user.resumes.password', $resume) }}"
                               class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-yellow-500 text-white hover:bg-yellow-600 font-semibold">
                                Set / Change Password
                            </a>

                            <form action="{{ route('user.resumes.destroy', $resume) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this resume?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 font-semibold">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-white border-2 border-slate-300 rounded-lg p-8 text-center">
                        <p class="text-slate-600 mb-4">
                            No resumes yet.
                        </p>

                        <a href="{{ route('user.resumes.create') }}"
                           class="inline-flex px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                            Create Your First Resume
                        </a>
                    </div>
                @endforelse

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