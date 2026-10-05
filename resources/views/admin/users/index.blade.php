<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-ink leading-tight">
                    Manage Users
                </h2>

                <p class="text-sm text-muted mt-1">
                    Create, edit, deactivate, and manage all platform users.
                </p>
            </div>

            <a href="{{ route('admin.users.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                Create New User
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

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-soft border border-red-soft text-red-strong rounded-md font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            <div class="space-y-6">

                <!-- Page Intro -->
                <div class="mb-6 bg-surface border border-line rounded-xl p-5">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-ink">
                                Users List
                            </h3>

                            <p class="text-sm text-muted mt-1">
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
                        <div class="bg-surface border border-line rounded-xl p-5 shadow-xs hover:shadow-md transition">

                            <!-- Top Row -->
                            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">

                                <!-- Main User Info -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-2 mb-3">
                                        <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-surface-soft text-muted">
                                            ID: {{ $user->id }}
                                        </span>

                                        @if ($user->role === 'admin')
                                            <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-purple-100 text-purple-700">
                                                Admin
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-blue-soft text-blue-strong">
                                                User
                                            </span>
                                        @endif

                                        @if ($user->status === 'active')
                                            <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-green-soft text-green-strong">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-red-soft text-red-strong">
                                                Inactive
                                            </span>
                                        @endif

                                        <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-surface-soft text-muted">
                                            {{ method_exists($user, 'resumes') ? $user->resumes()->count() : 0 }} resumes
                                        </span>
                                    </div>

                                    <h4 class="text-xl font-bold text-ink wrap-break-word">
                                        {{ $user->name }}
                                    </h4>

                                    <p class="text-muted mt-2 break-all">
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
                                                    class="w-full inline-flex justify-center px-4 py-2 rounded-md bg-surface-soft text-ink border border-line hover:bg-surface font-semibold text-sm">
                                                Deactivate
                                            </button>
                                        </form>
                                    @else
                                        <span class="w-full inline-flex justify-center px-4 py-2 rounded-md bg-surface-soft text-muted font-semibold text-sm">
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

                                <div class="bg-surface-soft border border-line rounded-md p-4">
                                    <p class="text-xs text-muted font-bold uppercase tracking-wide">
                                        Role
                                    </p>

                                    <p class="font-bold text-ink mt-1">
                                        {{ ucfirst($user->role) }}
                                    </p>
                                </div>

                                <div class="bg-surface-soft border border-line rounded-md p-4">
                                    <p class="text-xs text-muted font-bold uppercase tracking-wide">
                                        Status
                                    </p>

                                    <p class="font-bold text-ink mt-1">
                                        {{ ucfirst($user->status) }}
                                    </p>
                                </div>

                                <div class="bg-surface-soft border border-line rounded-md p-4">
                                    <p class="text-xs text-muted font-bold uppercase tracking-wide">
                                        Created
                                    </p>

                                    <p class="font-bold text-ink mt-1">
                                        {{ $user->created_at ? $user->created_at->format('Y-m-d') : 'Unknown' }}
                                    </p>
                                </div>

                            </div>

                        </div>
                    @empty
                        <div class="bg-surface border border-line rounded-xl p-8 text-center">
                            <p class="text-muted">
                                No users found.
                            </p>
                        </div>
                    @endforelse
                </div>

            </div>

        </div>
    </div>
</x-app-layout>