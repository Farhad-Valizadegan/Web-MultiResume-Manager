<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Manage Resumes
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    View, monitor, and manage all user resumes across the platform.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-slate-800 text-white rounded-md hover:bg-slate-900 font-semibold">
                Back to Admin Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gradient-to-br from-slate-900 via-slate-800 to-blue-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border-2 border-green-200 text-green-700 rounded-md font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-slate-300 shadow-2xl sm:rounded-lg p-4 sm:p-6 border-2 border-slate-500">

                <!-- Page Intro -->
                <div class="mb-6 bg-white border-2 border-slate-300 rounded-lg p-5">
                    <h3 class="text-lg font-extrabold text-slate-900">
                        All User Resumes
                    </h3>

                    <p class="text-sm text-slate-600 mt-1">
                        Admin can manage all resumes and monitor view analytics across the system.
                    </p>
                </div>

                <!-- Resume Cards -->
                <div class="space-y-5">
                    @forelse ($resumes as $resume)
                        <div class="bg-white border-2 border-slate-300 rounded-lg p-5 shadow-sm hover:shadow-md transition">

                            <!-- Top Row -->
                            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">

                                <!-- Main Info -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                        <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-700">
                                            ID: {{ $resume->id }}
                                        </span>

                                        @if ($resume->status === 'active')
                                            <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-green-100 text-green-700">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-red-100 text-red-700">
                                                Inactive
                                            </span>
                                        @endif

                                        <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-blue-100 text-blue-700">
                                            {{ $resume->view_count ?? 0 }} views
                                        </span>
                                    </div>

                                    <h4 class="text-xl font-extrabold text-slate-900 break-words">
                                        {{ $resume->title }}
                                    </h4>

                                    <p class="text-slate-600 mt-2 break-words">
                                        Job Position:
                                        <span class="font-semibold text-slate-800">
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

                                <div class="bg-slate-50 border border-slate-200 rounded-md p-4">
                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-wide">
                                        Owner
                                    </p>

                                    <p class="font-bold text-slate-900 mt-1 break-words">
                                        {{ $resume->user->name ?? 'Unknown' }}
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-md p-4">
                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-wide">
                                        Email
                                    </p>

                                    <p class="font-bold text-slate-900 mt-1 break-all">
                                        {{ $resume->user->email ?? 'Unknown' }}
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-md p-4">
                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-wide">
                                        Last Viewed
                                    </p>

                                    <p class="font-bold text-slate-900 mt-1">
                                        @if ($resume->last_viewed_at)
                                            {{ $resume->last_viewed_at->format('Y-m-d H:i') }}
                                        @else
                                            <span class="text-slate-400">Never viewed</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-md p-4">
                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-wide">
                                        Created
                                    </p>

                                    <p class="font-bold text-slate-900 mt-1">
                                        {{ $resume->created_at->format('Y-m-d') }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="bg-white border-2 border-slate-300 rounded-lg p-8 text-center">
                            <p class="text-slate-600">
                                No resumes found.
                            </p>
                        </div>
                    @endforelse
                </div>

            </div>

        </div>
    </div>
</x-app-layout>