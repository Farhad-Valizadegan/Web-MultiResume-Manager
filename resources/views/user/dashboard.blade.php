<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    User Dashboard
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Overview of your resumes, visibility, and public view analytics.
                </p>
            </div>

            <a href="{{ route('user.resumes.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                Create New Resume
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-linear-to-br from-slate-900 via-slate-800 to-blue-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Dashboard Intro -->
            <section class="bg-slate-100 shadow-2xl border-2 border-slate-300 rounded-lg p-4 sm:p-6">
                <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                        <div>
                            <h3 class="text-2xl font-extrabold text-slate-900">
                                Welcome back, {{ auth()->user()->name }}
                            </h3>

                            <p class="text-slate-600 mt-2 max-w-2xl">
                                Track your resumes, public links, and employer view analytics. These numbers are visible only to you.
                            </p>
                        </div>

                        <div class="bg-blue-50 border-2 border-blue-100 rounded-lg px-5 py-4">
                            <p class="text-sm text-blue-600 font-bold uppercase tracking-wide">
                                Total Resume Views
                            </p>

                            <p class="text-4xl font-extrabold text-blue-700 mt-1">
                                {{ $totalViews }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Statistics Cards -->
            <section class="bg-slate-100 shadow-2xl border-2 border-slate-300 rounded-lg p-4 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

                    <div class="bg-white p-5 rounded-lg shadow-xs border-2 border-slate-300 hover:shadow-md transition">
                        <p class="text-sm text-slate-600 font-bold">
                            Total Resumes
                        </p>

                        <p class="text-3xl font-extrabold text-slate-900 mt-2">
                            {{ $totalResumes }}
                        </p>
                    </div>

                    <div class="bg-white p-5 rounded-lg shadow-xs border-2 border-green-200 hover:shadow-md transition">
                        <p class="text-sm text-slate-600 font-bold">
                            Active Resumes
                        </p>

                        <p class="text-3xl font-extrabold text-green-600 mt-2">
                            {{ $activeResumes }}
                        </p>
                    </div>

                    <div class="bg-white p-5 rounded-lg shadow-xs border-2 border-red-200 hover:shadow-md transition">
                        <p class="text-sm text-slate-600 font-bold">
                            Inactive Resumes
                        </p>

                        <p class="text-3xl font-extrabold text-red-600 mt-2">
                            {{ $inactiveResumes }}
                        </p>
                    </div>

                    <div class="bg-white p-5 rounded-lg shadow-xs border-2 border-blue-200 hover:shadow-md transition">
                        <p class="text-sm text-slate-600 font-bold">
                            Total Resume Views
                        </p>

                        <p class="text-3xl font-extrabold text-blue-600 mt-2">
                            {{ $totalViews }}
                        </p>
                    </div>

                </div>
            </section>

            <!-- Analytics Summary Boxes -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Most Viewed Resumes -->
                <div class="bg-slate-100 shadow-2xl border-2 border-slate-300 rounded-lg p-4 sm:p-6">
                    <div class="mb-5 bg-white border-2 border-slate-300 rounded-lg p-5">
                        <h3 class="text-lg font-extrabold text-slate-900">
                            Most Viewed Resumes
                        </h3>

                        <p class="text-sm text-slate-600 mt-1">
                            Your resumes ranked by public views.
                        </p>
                    </div>

                    <div class="space-y-3">
                        @forelse ($mostViewedResumes as $resume)
                            <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                    <div>
                                        <p class="font-extrabold text-slate-900">
                                            {{ $resume->title }}
                                        </p>

                                        <p class="text-sm text-slate-600 mt-1">
                                            {{ $resume->job_position ?? 'No target position' }}
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
                <div class="bg-slate-100 shadow-2xl border-2 border-slate-300 rounded-lg p-4 sm:p-6">
                    <div class="mb-5 bg-white border-2 border-slate-300 rounded-lg p-5">
                        <h3 class="text-lg font-extrabold text-slate-900">
                            Recently Viewed Resumes
                        </h3>

                        <p class="text-sm text-slate-600 mt-1">
                            Resumes most recently opened through public links.
                        </p>
                    </div>

                    <div class="space-y-3">
                        @forelse ($recentlyViewedResumes as $resume)
                            <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
                                <p class="font-extrabold text-slate-900">
                                    {{ $resume->title }}
                                </p>

                                <p class="text-sm text-slate-600 mt-1">
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

            <!-- Resume View Analytics -->
            <section class="bg-slate-100 shadow-2xl border-2 border-slate-300 rounded-lg p-4 sm:p-6">

                <div class="mb-5 bg-white border-2 border-slate-300 rounded-lg p-5">
                    <h3 class="text-lg font-extrabold text-slate-900">
                        Resume View Analytics
                    </h3>

                    <p class="text-sm text-slate-600 mt-1">
                        These numbers are visible only to you. Employers do not see this counter.
                    </p>
                </div>

                <div class="bg-white border-2 border-slate-300 rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-100 text-slate-700">
                                <tr>
                                    <th class="text-left px-6 py-3 border-b-2 border-slate-300">Resume Title</th>
                                    <th class="text-left px-6 py-3 border-b-2 border-slate-300">Target Position</th>
                                    <th class="text-left px-6 py-3 border-b-2 border-slate-300">Status</th>
                                    <th class="text-left px-6 py-3 border-b-2 border-slate-300">Views</th>
                                    <th class="text-left px-6 py-3 border-b-2 border-slate-300">Last Viewed</th>
                                    <th class="text-left px-6 py-3 border-b-2 border-slate-300">Action</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y-2 divide-slate-100">
                                @forelse ($resumes as $resume)
                                    <tr class="hover:bg-slate-50">

                                        <td class="px-6 py-4 font-bold text-slate-900">
                                            {{ $resume->title }}
                                        </td>

                                        <td class="px-6 py-4 text-slate-700">
                                            {{ $resume->job_position ?? 'Not specified' }}
                                        </td>

                                        <td class="px-6 py-4">
                                            @if ($resume->status === 'active')
                                                <span class="px-3 py-1 rounded-md text-xs font-bold bg-green-100 text-green-700">
                                                    Active
                                                </span>
                                            @else
                                                <span class="px-3 py-1 rounded-md text-xs font-bold bg-red-100 text-red-700">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-md bg-blue-100 text-blue-700 font-bold text-xs">
                                                {{ $resume->view_count ?? 0 }} views
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 text-slate-600 whitespace-nowrap">
                                            @if ($resume->last_viewed_at)
                                                {{ $resume->last_viewed_at->format('Y-m-d H:i') }}
                                            @else
                                                Never viewed
                                            @endif
                                        </td>

                                        <td class="px-6 py-4">
                                            <a href="{{ route('user.resumes.edit', $resume) }}"
                                               class="inline-flex px-3 py-1 rounded-md bg-blue-600 text-white hover:bg-blue-700 font-semibold text-xs">
                                                Edit
                                            </a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-slate-600">
                                            No resumes created yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>

            <!-- Quick Actions -->
            <section class="bg-slate-100 shadow-2xl border-2 border-slate-300 rounded-lg p-4 sm:p-6">
                <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
                    <h3 class="text-lg font-extrabold text-slate-900 mb-4">
                        Quick Actions
                    </h3>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('user.resumes.create') }}"
                           class="inline-flex justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                            Create New Resume
                        </a>

                        <a href="{{ route('user.resumes.index') }}"
                           class="inline-flex justify-center px-4 py-2 bg-slate-700 text-white rounded-md hover:bg-slate-800 font-semibold">
                            Manage My Resumes
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