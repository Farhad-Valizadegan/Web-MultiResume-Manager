<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Manage Users
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Create, edit, deactivate, and manage all platform users.
                </p>
            </div>

            <a href="{{ route('admin.users.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                Create New User
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

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border-2 border-red-200 text-red-700 rounded-md font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-slate-300 shadow-2xl sm:rounded-lg p-4 sm:p-6 border-2 border-slate-500">

                <!-- Page Intro -->
                <div class="mb-6 bg-white border-2 border-slate-300 rounded-lg p-5">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-extrabold text-slate-900">
                                Users List
                            </h3>

                            <p class="text-sm text-slate-600 mt-1">
                                Admin can view user account details, roles, status, and resume ownership.
                            </p>
                        </div>

                        <a href="{{ route('admin.users.create') }}"
                           class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                            Create New User
                        </a>
                    </div>
                </div>

                <!-- User Cards -->
                <div class="space-y-5">
                    @forelse ($users as $user)
                        <div class="bg-white border-2 border-slate-300 rounded-lg p-5 shadow-xs hover:shadow-md transition">

                            <!-- Top Row -->
                            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">

                                <!-- Main User Info -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-2 mb-3">
                                        <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-700">
                                            ID: {{ $user->id }}
                                        </span>

                                        @if ($user->role === 'admin')
                                            <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-purple-100 text-purple-700">
                                                Admin
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-blue-100 text-blue-700">
                                                User
                                            </span>
                                        @endif

                                        @if ($user->status === 'active')
                                            <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-green-100 text-green-700">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-red-100 text-red-700">
                                                Inactive
                                            </span>
                                        @endif

                                        <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-700">
                                            {{ method_exists($user, 'resumes') ? $user->resumes()->count() : 0 }} resumes
                                        </span>
                                    </div>

                                    <h4 class="text-xl font-extrabold text-slate-900 wrap-break-word">
                                        {{ $user->name }}
                                    </h4>

                                    <p class="text-slate-600 mt-2 break-all">
                                        {{ $user->email }}
                                    </p>
                                </div>

                                <!-- Actions -->
                                <div class="flex flex-col sm:flex-row lg:flex-col gap-2 w-full sm:w-auto">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="w-full sm:w-auto inline-flex justify-center px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 font-semibold text-sm">
                                        Edit
                                    </a>

                                    @if ($user->status === 'active')
                                        <form action="{{ route('admin.users.deactivate', $user) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to deactivate this user?');">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="w-full inline-flex justify-center px-4 py-2 rounded-md bg-yellow-500 text-white hover:bg-yellow-600 font-semibold text-sm">
                                                Deactivate
                                            </button>
                                        </form>
                                    @else
                                        <span class="w-full inline-flex justify-center px-4 py-2 rounded-md bg-slate-200 text-slate-500 font-semibold text-sm">
                                            Deactivated
                                        </span>
                                    @endif

                                    <form action="{{ route('admin.users.destroy', $user) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this user?');">
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
                            <div class="mt-5 grid grid-cols-1 md:grid-cols-3 gap-4">

                                <div class="bg-slate-50 border border-slate-200 rounded-md p-4">
                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-wide">
                                        Role
                                    </p>

                                    <p class="font-bold text-slate-900 mt-1">
                                        {{ ucfirst($user->role) }}
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-md p-4">
                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-wide">
                                        Status
                                    </p>

                                    <p class="font-bold text-slate-900 mt-1">
                                        {{ ucfirst($user->status) }}
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-md p-4">
                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-wide">
                                        Created
                                    </p>

                                    <p class="font-bold text-slate-900 mt-1">
                                        {{ $user->created_at ? $user->created_at->format('Y-m-d') : 'Unknown' }}
                                    </p>
                                </div>

                            </div>

                        </div>
                    @empty
                        <div class="bg-white border-2 border-slate-300 rounded-lg p-8 text-center">
                            <p class="text-slate-600">
                                No users found.
                            </p>
                        </div>
                    @endforelse
                </div>

            </div>

        </div>
    </div>
</x-app-layout>