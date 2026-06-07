<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Admin Dashboard
                </h2>

                <p class="text-sm text-gray-500 mt-1">
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

    <div class="py-6 sm:py-12 bg-gradient-to-br from-slate-900 via-slate-800 to-blue-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- System Overview -->
            <section class="bg-slate-300 shadow-2xl border-2 border-slate-500 rounded-lg p-4 sm:p-6">
                <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                        <div>
                            <h3 class="text-2xl font-extrabold text-slate-900">
                                System Analytics Overview
                            </h3>

                            <p class="text-slate-600 mt-2 max-w-2xl">
                                Monitor all users, resumes, active public links, and total resume views across the platform.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="bg-blue-50 border-2 border-blue-100 rounded-lg px-5 py-4">
                                <p class="text-sm text-blue-600 font-bold uppercase tracking-wide">
                                    Total Users
                                </p>

                                <p class="text-4xl font-extrabold text-blue-700 mt-1">
                                    {{ $totalUsers }}
                                </p>
                            </div>

                            <div class="bg-slate-50 border-2 border-slate-200 rounded-lg px-5 py-4">
                                <p class="text-sm text-slate-600 font-bold uppercase tracking-wide">
                                    Total Views
                                </p>

                                <p class="text-4xl font-extrabold text-slate-900 mt-1">
                                    {{ $totalViews }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Statistics Cards -->
            <section class="bg-slate-300 shadow-2xl border-2 border-slate-500 rounded-lg p-4 sm:p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-5">

                    <div class="bg-white p-5 rounded-lg shadow-sm border-2 border-slate-300 hover:shadow-md transition">
                        <p class="text-sm text-slate-600 font-bold">
                            Total Users
                        </p>

                        <p class="text-3xl font-extrabold text-slate-900 mt-2">
                            {{ $totalUsers }}
                        </p>
                    </div>

                    <div class="bg-white p-5 rounded-lg shadow-sm border-2 border-slate-300 hover:shadow-md transition">
                        <p class="text-sm text-slate-600 font-bold">
                            Total Resumes
                        </p>

                        <p class="text-3xl font-extrabold text-slate-900 mt-2">
                            {{ $totalResumes }}
                        </p>
                    </div>

                    <div class="bg-white p-5 rounded-lg shadow-sm border-2 border-green-200 hover:shadow-md transition">
                        <p class="text-sm text-slate-600 font-bold">
                            Active Resumes
                        </p>

                        <p class="text-3xl font-extrabold text-green-600 mt-2">
                            {{ $activeResumes }}
                        </p>
                    </div>

                    <div class="bg-white p-5 rounded-lg shadow-sm border-2 border-red-200 hover:shadow-md transition">
                        <p class="text-sm text-slate-600 font-bold">
                            Inactive Resumes
                        </p>

                        <p class="text-3xl font-extrabold text-red-600 mt-2">
                            {{ $inactiveResumes }}
                        </p>
                    </div>

                    <div class="bg-white p-5 rounded-lg shadow-sm border-2 border-blue-200 hover:shadow-md transition">
                        <p class="text-sm text-slate-600 font-bold">
                            Total Resume Views
                        </p>

                        <p class="text-3xl font-extrabold text-blue-600 mt-2">
                            {{ $totalViews }}
                        </p>
                    </div>

                </div>
            </section>

            <!-- Top Analytics Boxes -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Most Viewed Resumes -->
                <div class="bg-slate-300 shadow-2xl border-2 border-slate-500 rounded-lg p-4 sm:p-6">
                    <div class="mb-5 bg-white border-2 border-slate-300 rounded-lg p-5">
                        <h3 class="text-lg font-extrabold text-slate-900">
                            Most Viewed Resumes
                        </h3>

                        <p class="text-sm text-slate-600 mt-1">
                            Resumes ranked by total public views.
                        </p>
                    </div>

                    <div class="space-y-3">
                        @forelse ($mostViewedResumes as $resume)
                            <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                    <div class="min-w-0">
                                        <p class="font-extrabold text-slate-900 break-words">
                                            {{ $resume->title }}
                                        </p>

                                        <p class="text-sm text-slate-600 mt-1">
                                            Owner: {{ $resume->user->name ?? 'Unknown user' }}
                                        </p>

                                        <p class="text-sm text-slate-600">
                                            Position: {{ $resume->job_position ?? 'Not specified' }}
                                        </p>
                                    </div>

                                    <span class="inline-flex justify-center px-3 py-1 rounded-md bg-blue-100 text-blue-700 font-bold text-sm whitespace-nowrap">
                                        {{ $resume->view_count ?? 0 }} views
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
                                <p class="text-slate-600">
                                    No view data yet.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Recently Viewed Resumes -->
                <div class="bg-slate-300 shadow-2xl border-2 border-slate-500 rounded-lg p-4 sm:p-6">
                    <div class="mb-5 bg-white border-2 border-slate-300 rounded-lg p-5">
                        <h3 class="text-lg font-extrabold text-slate-900">
                            Recently Viewed Resumes
                        </h3>

                        <p class="text-sm text-slate-600 mt-1">
                            Resumes most recently opened through protected public links.
                        </p>
                    </div>

                    <div class="space-y-3">
                        @forelse ($recentlyViewedResumes as $resume)
                            <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
                                <p class="font-extrabold text-slate-900 break-words">
                                    {{ $resume->title }}
                                </p>

                                <p class="text-sm text-slate-600 mt-1">
                                    Owner: {{ $resume->user->name ?? 'Unknown user' }}
                                </p>

                                <p class="text-sm text-slate-600">
                                    Last viewed:
                                    {{ $resume->last_viewed_at->format('Y-m-d H:i') }}
                                </p>
                            </div>
                        @empty
                            <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
                                <p class="text-slate-600">
                                    No recent views yet.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </section>

            <!-- All Resume Analytics -->
            <section class="bg-slate-300 shadow-2xl border-2 border-slate-500 rounded-lg p-4 sm:p-6">

                <div class="mb-5 bg-white border-2 border-slate-300 rounded-lg p-5">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-extrabold text-slate-900">
                                All Resume Analytics
                            </h3>

                            <p class="text-sm text-slate-600 mt-1">
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
                        <div class="bg-white border-2 border-slate-300 rounded-lg p-5 shadow-sm hover:shadow-md transition">

                            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap gap-2 mb-3">
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

                                    <h4 class="text-lg font-extrabold text-slate-900 break-words">
                                        {{ $resume->title }}
                                    </h4>

                                    <p class="text-slate-600 mt-2 break-words">
                                        Owner:
                                        <span class="font-semibold text-slate-800">
                                            {{ $resume->user->name ?? 'Unknown user' }}
                                        </span>
                                    </p>

                                    <p class="text-slate-600 mt-1 break-words">
                                        Target Position:
                                        <span class="font-semibold text-slate-800">
                                            {{ $resume->job_position ?? 'Not specified' }}
                                        </span>
                                    </p>

                                    <p class="text-slate-600 mt-1">
                                        Last Viewed:
                                        <span class="font-semibold text-slate-800">
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
                        <div class="bg-white border-2 border-slate-300 rounded-lg p-8 text-center">
                            <p class="text-slate-600">
                                No resumes found.
                            </p>
                        </div>
                    @endforelse
                </div>

            </section>

            <!-- Quick Actions -->
            <section class="bg-slate-300 shadow-2xl border-2 border-slate-500 rounded-lg p-4 sm:p-6">
                <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
                    <h3 class="text-lg font-extrabold text-slate-900 mb-4">
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