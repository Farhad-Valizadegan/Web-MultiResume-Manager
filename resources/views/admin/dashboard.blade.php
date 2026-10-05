<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-ink leading-tight">
                    Admin Dashboard
                </h2>

                <p class="text-sm text-muted mt-1">
                    System overview, resume analytics, and user activity monitoring.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.users.index') }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-slate-800 text-white rounded-md hover:bg-slate-900 font-semibold">
                    Manage Users
                </a>

                <a href="{{ route('admin.resumes.index') }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                    Manage Resumes
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-canvas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- System Overview -->
            <section class="bg-surface-soft shadow-sm border border-line rounded-xl p-4 sm:p-6">
                <div class="bg-surface border border-line rounded-xl p-5">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                        <div>
                            <h3 class="text-2xl font-bold text-ink">
                                System Analytics Overview
                            </h3>

                            <p class="text-muted mt-2 max-w-2xl">
                                Monitor all users, resumes, active public links, and total resume views across the platform.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="bg-blue-soft border border-blue-soft rounded-xl px-5 py-4">
                                <p class="text-sm text-blue-strong font-bold uppercase tracking-wide">
                                    Total Users
                                </p>

                                <p class="text-4xl font-bold text-blue-strong mt-1">
                                    {{ $totalUsers }}
                                </p>
                            </div>

                            <div class="bg-surface-soft border border-line rounded-xl px-5 py-4">
                                <p class="text-sm text-muted font-bold uppercase tracking-wide">
                                    Total Views
                                </p>

                                <p class="text-4xl font-bold text-ink mt-1">
                                    {{ $totalViews }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Statistics Cards -->
            <section class="bg-surface-soft shadow-sm border border-line rounded-xl p-4 sm:p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-5">

                    <div class="bg-surface p-5 rounded-xl shadow-xs border border-line hover:shadow-md transition">
                        <p class="text-sm text-muted font-bold">
                            Total Users
                        </p>

                        <p class="text-3xl font-bold text-ink mt-2">
                            {{ $totalUsers }}
                        </p>
                    </div>

                    <div class="bg-surface p-5 rounded-xl shadow-xs border border-line hover:shadow-md transition">
                        <p class="text-sm text-muted font-bold">
                            Total Resumes
                        </p>

                        <p class="text-3xl font-bold text-ink mt-2">
                            {{ $totalResumes }}
                        </p>
                    </div>

                    <div class="bg-surface p-5 rounded-xl shadow-xs border border-green-soft hover:shadow-md transition">
                        <p class="text-sm text-muted font-bold">
                            Active Resumes
                        </p>

                        <p class="text-3xl font-bold text-green-strong mt-2">
                            {{ $activeResumes }}
                        </p>
                    </div>

                    <div class="bg-surface p-5 rounded-xl shadow-xs border border-red-soft hover:shadow-md transition">
                        <p class="text-sm text-muted font-bold">
                            Inactive Resumes
                        </p>

                        <p class="text-3xl font-bold text-red-strong mt-2">
                            {{ $inactiveResumes }}
                        </p>
                    </div>

                    <div class="bg-surface p-5 rounded-xl shadow-xs border border-blue-soft hover:shadow-md transition">
                        <p class="text-sm text-muted font-bold">
                            Total Resume Views
                        </p>

                        <p class="text-3xl font-bold text-blue-strong mt-2">
                            {{ $totalViews }}
                        </p>
                    </div>

                </div>
            </section>

            <!-- Top Analytics Boxes -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Most Viewed Resumes -->
                <div class="bg-surface-soft shadow-sm border border-line rounded-xl p-4 sm:p-6">
                    <div class="mb-5 bg-surface border border-line rounded-xl p-5">
                        <h3 class="text-lg font-bold text-ink">
                            Most Viewed Resumes
                        </h3>

                        <p class="text-sm text-muted mt-1">
                            Resumes ranked by total public views.
                        </p>
                    </div>

                    <div class="space-y-3">
                        @forelse ($mostViewedResumes as $resume)
                            <div class="bg-surface border border-line rounded-xl p-4">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                    <div class="min-w-0">
                                        <p class="font-bold text-ink wrap-break-word">
                                            {{ $resume->title }}
                                        </p>

                                        <p class="text-sm text-muted mt-1">
                                            Owner: {{ $resume->user->name ?? 'Unknown user' }}
                                        </p>

                                        <p class="text-sm text-muted">
                                            Position: {{ $resume->job_position ?? 'Not specified' }}
                                        </p>
                                    </div>

                                    <span class="inline-flex justify-center px-3 py-1 rounded-md bg-blue-soft text-blue-strong font-bold text-sm whitespace-nowrap">
                                        {{ $resume->view_count ?? 0 }} views
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="bg-surface border border-line rounded-xl p-5">
                                <p class="text-muted">
                                    No view data yet.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Recently Viewed Resumes -->
                <div class="bg-surface-soft shadow-sm border border-line rounded-xl p-4 sm:p-6">
                    <div class="mb-5 bg-surface border border-line rounded-xl p-5">
                        <h3 class="text-lg font-bold text-ink">
                            Recently Viewed Resumes
                        </h3>

                        <p class="text-sm text-muted mt-1">
                            Resumes most recently opened through protected public links.
                        </p>
                    </div>

                    <div class="space-y-3">
                        @forelse ($recentlyViewedResumes as $resume)
                            <div class="bg-surface border border-line rounded-xl p-4">
                                <p class="font-bold text-ink wrap-break-word">
                                    {{ $resume->title }}
                                </p>

                                <p class="text-sm text-muted mt-1">
                                    Owner: {{ $resume->user->name ?? 'Unknown user' }}
                                </p>

                                <p class="text-sm text-muted">
                                    Last viewed:
                                    {{ $resume->last_viewed_at->format('Y-m-d H:i') }}
                                </p>
                            </div>
                        @empty
                            <div class="bg-surface border border-line rounded-xl p-5">
                                <p class="text-muted">
                                    No recent views yet.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </section>

            <!-- All Resume Analytics -->
            <section class="bg-surface-soft shadow-sm border border-line rounded-xl p-4 sm:p-6">

                <div class="mb-5 bg-surface border border-line rounded-xl p-5">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-ink">
                                All Resume Analytics
                            </h3>

                            <p class="text-sm text-muted mt-1">
                                View statistics for all resumes in the system without horizontal scrolling.
                            </p>
                        </div>

                        <a href="{{ route('admin.resumes.index') }}"
                           class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                            Manage All Resumes
                        </a>
                    </div>
                </div>

                <div class="space-y-4">
                    @forelse ($allResumes as $resume)
                        <div class="bg-surface border border-line rounded-xl p-5 shadow-xs hover:shadow-md transition">

                            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap gap-2 mb-3">
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

                                    <h4 class="text-lg font-bold text-ink wrap-break-word">
                                        {{ $resume->title }}
                                    </h4>

                                    <p class="text-muted mt-2 wrap-break-word">
                                        Owner:
                                        <span class="font-semibold text-ink">
                                            {{ $resume->user->name ?? 'Unknown user' }}
                                        </span>
                                    </p>

                                    <p class="text-muted mt-1 wrap-break-word">
                                        Target Position:
                                        <span class="font-semibold text-ink">
                                            {{ $resume->job_position ?? 'Not specified' }}
                                        </span>
                                    </p>

                                    <p class="text-muted mt-1">
                                        Last Viewed:
                                        <span class="font-semibold text-ink">
                                            @if ($resume->last_viewed_at)
                                                {{ $resume->last_viewed_at->format('Y-m-d H:i') }}
                                            @else
                                                Never viewed
                                            @endif
                                        </span>
                                    </p>
                                </div>

                                <a href="{{ route('admin.resumes.show', $resume) }}"
                                   class="w-full lg:w-auto inline-flex justify-center px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 font-semibold text-sm">
                                    View Details
                                </a>
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

            </section>

            <!-- Quick Actions -->
            <section class="bg-surface-soft shadow-sm border border-line rounded-xl p-4 sm:p-6">
                <div class="bg-surface border border-line rounded-xl p-5">
                    <h3 class="text-lg font-bold text-ink mb-4">
                        Quick Actions
                    </h3>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex justify-center px-4 py-2 bg-slate-700 text-white rounded-md hover:bg-slate-800 font-semibold">
                            Manage Users
                        </a>

                        <a href="{{ route('admin.resumes.index') }}"
                           class="inline-flex justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                            Manage Resumes
                        </a>

                        <a href="{{ route('profile.edit') }}"
                           class="inline-flex justify-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>