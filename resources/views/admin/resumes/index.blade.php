<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-ink leading-tight">
                    Manage Resumes
                </h2>

                <p class="text-sm text-muted mt-1">
                    View, monitor, and manage all user resumes across the platform.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-slate-800 text-white rounded-md hover:bg-slate-900 font-semibold">
                Back to Admin Dashboard
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

            <div class="space-y-6">

                <!-- Page Intro -->
                <div class="mb-6 bg-surface border border-line rounded-xl p-5">
                    <h3 class="text-lg font-bold text-ink">
                        All User Resumes
                    </h3>

                    <p class="text-sm text-muted mt-1">
                        Admin can manage all resumes and monitor view analytics across the system.
                    </p>
                </div>

                <!-- Resume Cards -->
                <div class="space-y-5">
                    @forelse ($resumes as $resume)
                        <div class="bg-surface border border-line rounded-xl p-5 shadow-xs hover:shadow-md transition">

                            <!-- Top Row -->
                            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">

                                <!-- Main Info -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
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

                                    <h4 class="text-xl font-bold text-ink wrap-break-word">
                                        {{ $resume->title }}
                                    </h4>

                                    <p class="text-muted mt-2 wrap-break-word">
                                        Job Position:
                                        <span class="font-semibold text-ink">
                                            {{ $resume->job_position ?? 'Not specified' }}
                                        </span>
                                    </p>
                                </div>

                                <!-- Actions -->
                                <div class="flex flex-col sm:flex-row lg:flex-col gap-2 w-full sm:w-auto">
                                    <a href="{{ route('admin.resumes.show', $resume) }}"
                                       class="w-full sm:w-auto inline-flex justify-center px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 font-semibold text-sm">
                                        View Details
                                    </a>

                                    <a href="{{ url('/resume/' . $resume->public_link) }}"
                                       target="_blank"
                                       class="w-full sm:w-auto inline-flex justify-center px-4 py-2 rounded-md bg-slate-700 text-white hover:bg-slate-800 font-semibold text-sm">
                                        Open Public Link
                                    </a>

                                    <form action="{{ route('admin.resumes.destroy', $resume) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this resume?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="w-full inline-flex justify-center px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 font-semibold text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>

                            </div>

                            <!-- Details Grid -->
                            <div class="mt-5 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">

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
                                        {{ $resume->created_at->format('Y-m-d') }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="bg-surface border border-line rounded-xl p-8 text-center">
                            <p class="text-muted">
                                No resumes found.
                            </p>
                        </div>
                    @endforelse
                </div>

            </div>

        </div>
    </div>
</x-app-layout>