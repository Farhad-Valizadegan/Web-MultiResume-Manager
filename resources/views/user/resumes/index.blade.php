<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-ink leading-tight">
                    My Resumes
                </h2>

                <p class="text-sm text-muted mt-1">
                    Manage your resumes, public links, passwords, downloads, and view analytics.
                </p>
            </div>

            <a href="{{ route('user.resumes.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                Create New Resume
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-canvas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-soft border border-green-soft text-green-strong rounded-md font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div id="copy-message" role="status" aria-live="polite" class="hidden mb-4 p-4 bg-blue-soft border border-blue-soft text-blue-strong rounded-md font-semibold">
                Public resume link copied successfully.
            </div>

            <div class="space-y-6">

                <!-- Page Intro -->
                <div class="mb-6 bg-surface border border-line rounded-xl p-5">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-ink">
                                Resume List
                            </h3>

                            <p class="text-sm text-muted mt-1">
                                Each resume has its own public link, password, download settings, and view counter.
                            </p>
                        </div>

                        <a href="{{ route('user.resumes.create') }}"
                           class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                            Create New Resume
                        </a>
                    </div>
                </div>

                <div class="rf-resume-filter mb-5 flex flex-col sm:flex-row gap-3">
                    <label class="flex-1"><span class="sr-only">Search resumes</span><input type="search" data-resume-search placeholder="Search by title or job position" class="w-full"></label>
                    <label><span class="sr-only">Filter by status</span><select data-resume-status><option value="all">All statuses</option><option value="active">Active</option><option value="inactive">Inactive</option></select></label>
                </div>
                <p data-resume-results role="status" aria-live="polite" class="text-sm text-muted mb-4"></p>
                @forelse ($resumes as $resume)
                    @php
                        $publicUrl = url('/resume/' . $resume->public_link);
                    @endphp

                    <article data-resume-card data-search="{{ $resume->title }} {{ $resume->job_position }}" data-status="{{ $resume->status }}" class="bg-surface border border-line rounded-xl p-4 sm:p-5 mb-5 shadow-xs hover:shadow-md transition">

                        <!-- Resume Header -->
                        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">

                            <div class="flex-1">
                                <h4 class="text-lg sm:text-xl font-bold text-ink wrap-break-word">
                                    {{ $resume->title }}
                                </h4>

                                <p class="text-muted mt-2 wrap-break-word">
                                    Job Position:
                                    <span class="font-semibold text-ink">
                                        {{ $resume->job_position ?? 'Not specified' }}
                                    </span>
                                </p>

                                <p class="text-muted mt-2">
                                    Status:
                                    @if ($resume->status === 'active')
                                        <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-green-soft text-green-strong">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-red-soft text-red-strong">
                                            Inactive
                                        </span>
                                    @endif
                                </p>
                            </div>

                            <!-- View Counter Box -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 min-w-full lg:min-w-0 lg:w-auto">
                                <div class="bg-blue-soft border border-blue-soft rounded-xl px-4 py-3">
                                    <p class="text-xs text-blue-strong font-bold uppercase tracking-wide">
                                        Views
                                    </p>

                                    <p class="text-2xl font-bold text-blue-strong mt-1">
                                        {{ $resume->view_count ?? 0 }}
                                    </p>
                                </div>

                                <div class="bg-surface-soft border border-line rounded-xl px-4 py-3">
                                    <p class="text-xs text-muted font-bold uppercase tracking-wide">
                                        Last Viewed
                                    </p>

                                    <p class="text-sm font-bold text-ink mt-2">
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
                        <div class="mt-5 bg-surface-soft border border-line rounded-xl p-4">
                            <p class="text-muted mb-2 font-bold">
                                Public Link
                            </p>

                            <div class="flex flex-col lg:flex-row lg:items-center gap-2">
                                <input type="text"
                                       value="{{ $publicUrl }}"
                                       readonly
                                       class="w-full lg:flex-1 border border-line rounded-md shadow-xs font-mono text-sm px-3 py-2">

                                <button type="button"
                                        onclick="copyResumeLink('{{ $publicUrl }}')"
                                        class="w-full lg:w-auto whitespace-nowrap px-4 py-2 bg-slate-700 text-white rounded-md hover:bg-slate-800 font-semibold">
                                    Copy Link
                                </button>
                            </div>
                        </div>

                        <!-- Password and Access Info -->
                        <div class="mt-5 grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div class="bg-surface-soft border border-line rounded-xl p-4">
                                <p class="text-muted font-bold">
                                    Resume password
                                </p>

                                @if ($resume->resume_password_hash)
                                    <span class="font-mono bg-surface border border-line px-2 py-1 rounded-md break-all inline-block mt-2">
                                        Password set (hidden)
                                    </span>
                                @else
                                    <span class="text-muted font-semibold inline-block mt-2">
                                        Public access
                                    </span>
                                @endif
                            </div>

                            <div class="bg-surface-soft border border-line rounded-xl p-4">
                                <p class="text-muted font-bold">
                                    Access Status
                                </p>

                                <p class="mt-2 text-ink font-medium">
                                    @if ($resume->resume_password_hash)
                                        Password protected
                                    @else
                                        Anyone with the link
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Download Type Info -->
                        <div class="mt-4 bg-surface-soft border border-line rounded-xl p-4">
                            <p class="text-muted font-bold">
                                Download Option
                            </p>

                            <p class="mt-2 text-ink font-medium">
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
                        <div class="mt-5 pt-5 border-t border-line flex flex-col sm:flex-row sm:flex-wrap gap-3">
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
                               class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-surface-soft text-ink border border-line hover:bg-surface font-semibold">
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
                    </article>
                @empty
                    <div class="bg-surface border border-line rounded-xl p-8 text-center">
                        <p class="text-muted mb-4">
                            No resumes yet.
                        </p>

                        <a href="{{ route('user.resumes.create') }}"
                           class="inline-flex px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                            Create Your First Resume
                        </a>
                    </div>
                @endforelse
                <p data-resume-empty hidden class="p-6 text-center text-muted">No resumes match your search. Try a different title or status.</p>

            </div>

        </div>
    </div>

    <script>
        function copyResumeLink(link) {
            navigator.clipboard.writeText(link).then(function () {
                const message = document.getElementById('copy-message');
                message.textContent = 'Public resume link copied successfully.';
                message.classList.remove('hidden');

                setTimeout(function () {
                    message.classList.add('hidden');
                }, 2500);
            }).catch(function () {
                const message = document.getElementById('copy-message');
                message.textContent = 'Could not copy automatically. Select the public link and copy it manually.';
                message.classList.remove('hidden');
            });
        }
    </script>
</x-app-layout>