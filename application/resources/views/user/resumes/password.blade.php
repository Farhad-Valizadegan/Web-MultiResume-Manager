<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-ink leading-tight">
                    Set / Change Resume Password
                </h2>

                <p class="text-sm text-muted mt-1">
                    Control employer access to your protected public resume link.
                </p>
            </div>

            <a href="{{ route('user.resumes.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-slate-800 text-white rounded-md hover:bg-slate-900 font-semibold">
                Back to My Resumes
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-canvas">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="space-y-6">

                <!-- Page Intro -->
                <div class="mb-6 bg-surface border border-line rounded-xl p-5">
                    <h3 class="text-lg font-bold text-ink">
                        Employer Access Password
                    </h3>

                    <p class="text-sm text-muted mt-1">
                        Set a password that employers must enter before viewing this public resume.
                    </p>
                </div>

                <!-- Resume Summary -->
                <section class="bg-surface border border-line rounded-xl p-5 mb-6">
                    <h4 class="text-base font-bold text-ink">
                        Resume Information
                    </h4>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-surface-soft border border-line rounded-md p-4">
                            <p class="text-sm text-muted font-semibold">
                                Resume Title
                            </p>

                            <p class="font-bold text-ink mt-1 wrap-break-word">
                                {{ $resume->title }}
                            </p>
                        </div>

                        <div class="bg-surface-soft border border-line rounded-md p-4">
                            <p class="text-sm text-muted font-semibold">
                                Target Position
                            </p>

                            <p class="font-bold text-ink mt-1 wrap-break-word">
                                {{ $resume->job_position ?? 'Not specified' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 bg-blue-soft border border-blue-soft rounded-md p-4">
                        <p class="text-sm text-blue-strong leading-relaxed">
                            This password is only for employers who open your public resume link.
                            It is separate from your account login password.
                        </p>
                    </div>
                </section>

                <!-- Password Form -->
                <section class="bg-surface border border-line rounded-xl p-5">
                    <div class="mb-5 bg-surface-soft border border-line rounded-md p-4">
                        <h4 class="text-base font-bold text-ink">
                            Update Password
                        </h4>

                        <p class="text-sm text-muted mt-1">
                            Use at least 6 characters. Share this password only with trusted employers.
                        </p>
                    </div>

                    <form method="POST"
                          action="{{ route('user.resumes.updatePassword', $resume) }}"
                          class="space-y-5">
                        @csrf
                        @method('PUT')

                        <!-- New Password -->
                        <div>
                            <label for="resume_password" class="block mb-2 font-bold text-ink">
                                New Password
                                <span class="text-red-strong">*</span>
                            </label>

                            <input id="resume_password"
                                   type="password"
                                   name="resume_password"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Enter new employer password"
                                   required>

                            @error('resume_password')
                                <p class="text-red-strong text-sm mt-2 font-semibold">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="resume_password_confirmation" class="block mb-2 font-bold text-ink">
                                Confirm Password
                                <span class="text-red-strong">*</span>
                            </label>

                            <input id="resume_password_confirmation"
                                   type="password"
                                   name="resume_password_confirmation"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Repeat new employer password"
                                   required>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row sm:justify-between gap-3 pt-5 border-t border-line">
                            <a href="{{ route('user.resumes.index') }}"
                               class="w-full sm:w-auto inline-flex justify-center px-5 py-2.5 bg-slate-700 text-white rounded-md hover:bg-slate-800 font-semibold">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="w-full sm:w-auto inline-flex justify-center px-5 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                                Save Password
                            </button>
                        </div>
                    </form>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>