<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Edit User
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Update user account information, role, and access status.
                </p>
            </div>

            <a href="{{ route('admin.users.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-slate-800 text-white rounded-md hover:bg-slate-900 font-semibold">
                Back to Users
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-linear-to-br from-slate-900 via-slate-800 to-blue-950">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-slate-300 shadow-2xl sm:rounded-lg p-4 sm:p-6 border-2 border-slate-500">

                <!-- Page Intro -->
                <div class="mb-6 bg-white border-2 border-slate-300 rounded-lg p-5">
                    <h3 class="text-lg font-extrabold text-slate-900">
                        User Account Information
                    </h3>

                    <p class="text-sm text-slate-600 mt-1">
                        Editing account:
                        <span class="font-bold text-slate-900">
                            {{ $user->name }}
                        </span>
                    </p>
                </div>

                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information -->
                    <section class="bg-white border-2 border-slate-300 rounded-lg p-5">
                        <div class="mb-5 bg-slate-100 border border-slate-300 rounded-md p-4">
                            <h4 class="text-base font-extrabold text-slate-900">
                                Basic Information
                            </h4>

                            <p class="text-sm text-slate-600 mt-1">
                                Update the user's name and email address.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <!-- Name -->
                            <div>
                                <label for="name" class="block mb-2 font-bold text-slate-800">
                                    Name
                                    <span class="text-red-600">*</span>
                                </label>

                                <input id="name"
                                       type="text"
                                       name="name"
                                       value="{{ old('name', $user->name) }}"
                                       class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Enter full name"
                                       required>

                                @error('name')
                                    <p class="text-red-600 text-sm mt-2 font-semibold">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block mb-2 font-bold text-slate-800">
                                    Email
                                    <span class="text-red-600">*</span>
                                </label>

                                <input id="email"
                                       type="email"
                                       name="email"
                                       value="{{ old('email', $user->email) }}"
                                       class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Enter email address"
                                       required>

                                @error('email')
                                    <p class="text-red-600 text-sm mt-2 font-semibold">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>
                    </section>

                    <!-- Account Settings -->
                    <section class="bg-white border-2 border-slate-300 rounded-lg p-5">
                        <div class="mb-5 bg-slate-100 border border-slate-300 rounded-md p-4">
                            <h4 class="text-base font-extrabold text-slate-900">
                                Account Settings
                            </h4>

                            <p class="text-sm text-slate-600 mt-1">
                                Update the user role and account status.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <!-- Role -->
                            <div>
                                <label for="role" class="block mb-2 font-bold text-slate-800">
                                    Role
                                    <span class="text-red-600">*</span>
                                </label>

                                <select id="role"
                                        name="role"
                                        class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>
                                        User
                                    </option>

                                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                </select>

                                @error('role')
                                    <p class="text-red-600 text-sm mt-2 font-semibold">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block mb-2 font-bold text-slate-800">
                                    Status
                                    <span class="text-red-600">*</span>
                                </label>

                                <select id="status"
                                        name="status"
                                        class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="inactive" {{ old('status', $user->status) === 'inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>

                                @error('status')
                                    <p class="text-red-600 text-sm mt-2 font-semibold">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>
                    </section>

                    <!-- Account Summary -->
                    <section class="bg-white border-2 border-slate-300 rounded-lg p-5">
                        <div class="mb-5 bg-slate-100 border border-slate-300 rounded-md p-4">
                            <h4 class="text-base font-extrabold text-slate-900">
                                Account Summary
                            </h4>

                            <p class="text-sm text-slate-600 mt-1">
                                Read-only system information about this user.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <div class="bg-slate-50 border border-slate-200 rounded-md p-4">
                                <p class="text-xs text-slate-500 font-bold uppercase tracking-wide">
                                    User ID
                                </p>

                                <p class="font-bold text-slate-900 mt-1">
                                    {{ $user->id }}
                                </p>
                            </div>

                            <div class="bg-slate-50 border border-slate-200 rounded-md p-4">
                                <p class="text-xs text-slate-500 font-bold uppercase tracking-wide">
                                    Created At
                                </p>

                                <p class="font-bold text-slate-900 mt-1">
                                    {{ $user->created_at ? $user->created_at->format('Y-m-d') : 'Unknown' }}
                                </p>
                            </div>

                            <div class="bg-slate-50 border border-slate-200 rounded-md p-4">
                                <p class="text-xs text-slate-500 font-bold uppercase tracking-wide">
                                    Resumes
                                </p>

                                <p class="font-bold text-slate-900 mt-1">
                                    {{ method_exists($user, 'resumes') ? $user->resumes()->count() : 0 }}
                                </p>
                            </div>

                        </div>
                    </section>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-6 border-t-2 border-slate-500">
                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex justify-center px-5 py-2.5 bg-slate-700 text-white rounded-md hover:bg-slate-800 font-semibold">
                            Cancel
                        </a>

                        <button type="submit"
                                class="inline-flex justify-center px-5 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                            Update User
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>