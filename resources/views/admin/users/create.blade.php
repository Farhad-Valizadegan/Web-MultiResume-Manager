<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-ink leading-tight">
                    Create User
                </h2>

                <p class="text-sm text-muted mt-1">
                    Add a new user account and assign role and access status.
                </p>
            </div>

            <a href="{{ route('admin.users.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-slate-800 text-white rounded-md hover:bg-slate-900 font-semibold">
                Back to Users
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-canvas">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="space-y-6">

                <!-- Page Intro -->
                <div class="mb-6 bg-surface border border-line rounded-xl p-5">
                    <h3 class="text-lg font-bold text-ink">
                        New User Information
                    </h3>

                    <p class="text-sm text-muted mt-1">
                        Fill in the required information to create a new platform user.
                    </p>
                </div>

                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                    @csrf

                    <!-- Basic Information -->
                    <section class="bg-surface border border-line rounded-xl p-5">
                        <div class="mb-5 bg-surface-soft border border-line rounded-md p-4">
                            <h4 class="text-base font-bold text-ink">
                                Basic Information
                            </h4>

                            <p class="text-sm text-muted mt-1">
                                User name and email address.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block mb-2 font-bold text-ink">
                                    Name
                                    <span class="text-red-strong">*</span>
                                </label>

                                <input id="name"
                                       type="text"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Enter full name"
                                       required>

                                @error('name')
                                    <p class="text-red-strong text-sm mt-2 font-semibold">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block mb-2 font-bold text-ink">
                                    Email
                                    <span class="text-red-strong">*</span>
                                </label>

                                <input id="email"
                                       type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Enter email address"
                                       required>

                                @error('email')
                                    <p class="text-red-strong text-sm mt-2 font-semibold">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <!-- Security -->
                    <section class="bg-surface border border-line rounded-xl p-5">
                        <div class="mb-5 bg-surface-soft border border-line rounded-md p-4">
                            <h4 class="text-base font-bold text-ink">
                                Security
                            </h4>

                            <p class="text-sm text-muted mt-1">
                                Set a temporary password for the new user.
                            </p>
                        </div>

                        <div>
                            <label for="password" class="block mb-2 font-bold text-ink">
                                Password
                                <span class="text-red-strong">*</span>
                            </label>

                            <input id="password"
                                   type="password"
                                   name="password"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Enter temporary password"
                                   required>

                            <p class="text-sm text-muted mt-2">
                                The user can change this password later from their account.
                            </p>

                            @error('password')
                                <p class="text-red-strong text-sm mt-2 font-semibold">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </section>

                    <!-- Account Settings -->
                    <section class="bg-surface border border-line rounded-xl p-5">
                        <div class="mb-5 bg-surface-soft border border-line rounded-md p-4">
                            <h4 class="text-base font-bold text-ink">
                                Account Settings
                            </h4>

                            <p class="text-sm text-muted mt-1">
                                Choose the user role and account status.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Role -->
                            <div>
                                <label for="role" class="block mb-2 font-bold text-ink">
                                    Role
                                    <span class="text-red-strong">*</span>
                                </label>

                                <select id="role"
                                        name="role"
                                        class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="user" {{ old('role', 'user') === 'user' ? 'selected' : '' }}>
                                        User
                                    </option>

                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                </select>

                                @error('role')
                                    <p class="text-red-strong text-sm mt-2 font-semibold">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block mb-2 font-bold text-ink">
                                    Status
                                    <span class="text-red-strong">*</span>
                                </label>

                                <select id="status"
                                        name="status"
                                        class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>

                                @error('status')
                                    <p class="text-red-strong text-sm mt-2 font-semibold">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-6 border-t border-line">
                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex justify-center px-5 py-2.5 bg-slate-700 text-white rounded-md hover:bg-slate-800 font-semibold">
                            Cancel
                        </a>

                        <button type="submit"
                                class="inline-flex justify-center px-5 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                            Save User
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>