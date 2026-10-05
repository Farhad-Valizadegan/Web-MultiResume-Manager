<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-ink leading-tight">
                    Edit Resume
                </h2>

                <p class="text-sm text-muted mt-1">
                    Update your resume information, public access, skills, education, experience, projects, and certificates.
                </p>
            </div>

            <a href="{{ route('user.resumes.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-slate-800 text-white rounded-md hover:bg-slate-900 font-semibold">
                Back to My Resumes
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-canvas">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="space-y-6">

                <!-- Page Intro -->


                <form data-resume-editor method="POST"
                      action="{{ route('user.resumes.update', $resume) }}"
                      enctype="multipart/form-data"
                      class="space-y-6">
                    @if($errors->any())<div role="alert" class="bg-red-soft text-red-strong border border-red-soft rounded-xl p-4"><p class="font-semibold">Please review the highlighted fields.</p><ul class="mt-2 list-disc pl-5 text-sm">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                    @csrf
                    <nav class="rf-form-navigation" aria-label="Resume sections"><span>Jump to section</span><div data-section-links></div></nav>
                    @method('PUT')

                    <!-- Basic Information -->
                    <section class="border border-line rounded-xl p-4 sm:p-5 bg-surface shadow-xs">
                        <div class="mb-4 bg-surface-soft border border-line rounded-md p-4">
                            <h4 class="text-base font-bold text-ink">
                                Basic Information
                            </h4>

                            <p class="text-sm text-muted mt-1">
                                Resume title, target position, public access, and download settings.
                            </p>
                        </div>

                        <div class="bg-surface border border-line rounded-md p-4">
                            @include('user.resumes.partials.basic-info')
                        </div>
                    </section>

                    <!-- Resume Display Settings -->
                    <section class="border border-line rounded-xl p-4 sm:p-5 bg-surface shadow-xs">
                        <div class="mb-4 bg-surface-soft border border-line rounded-md p-4">
                            <h4 class="text-base font-bold text-ink">
                                Resume Display Settings
                            </h4>

                            <p class="text-sm text-muted mt-1">
                                Choose how the public resume page should display skills and visual theme.
                            </p>
                        </div>

                        <div class="space-y-6">

                            <!-- Skills Display Style -->
                            <div class="bg-surface border border-line rounded-md p-4">
                                <label class="block text-sm font-bold text-ink mb-3">
                                    Skills Display Style
                                </label>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <!-- Compact List Option -->
                                    <label class="flex items-start gap-3 rounded-xl border border-line bg-surface-soft p-4 cursor-pointer hover:bg-blue-soft hover:border-blue-300 transition">
                                        <input
                                            type="radio"
                                            name="skill_display_style"
                                            value="compact"
                                            class="mt-1"
                                            {{ old('skill_display_style', $resume->skill_display_style ?? 'compact') === 'compact' ? 'checked' : '' }}
                                        >

                                        <span>
                                            <span class="block font-bold text-ink">
                                                Compact List
                                            </span>

                                            <span class="block text-sm text-muted mt-1">
                                                Shows skills grouped by category in a clean line-based format.
                                            </span>

                                            <span class="block text-xs text-muted mt-2">
                                                Example: Programming Languages: PHP, JavaScript, Python
                                            </span>
                                        </span>
                                    </label>

                                    <!-- Card View Option -->
                                    <label class="flex items-start gap-3 rounded-xl border border-line bg-surface-soft p-4 cursor-pointer hover:bg-blue-soft hover:border-blue-300 transition">
                                        <input
                                            type="radio"
                                            name="skill_display_style"
                                            value="cards"
                                            class="mt-1"
                                            {{ old('skill_display_style', $resume->skill_display_style ?? 'compact') === 'cards' ? 'checked' : '' }}
                                        >

                                        <span>
                                            <span class="block font-bold text-ink">
                                                Card View
                                            </span>

                                            <span class="block text-sm text-muted mt-1">
                                                Shows each skill category as a separate visual card.
                                            </span>

                                            <span class="block text-xs text-muted mt-2">
                                                Best for resumes with many grouped technical skills.
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                @error('skill_display_style')
                                    <p class="text-red-strong text-sm mt-3">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Resume Theme -->
                            <div class="bg-surface border border-line rounded-md p-4">
                                <label class="block text-sm font-bold text-ink mb-3">
                                    Resume Theme
                                </label>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <!-- Professional Blue -->
                                    <label class="flex items-start gap-3 rounded-xl border border-line bg-surface-soft p-4 cursor-pointer hover:bg-blue-soft hover:border-blue-300 transition">
                                        <input
                                            type="radio"
                                            name="theme"
                                            value="professional_blue"
                                            class="mt-1"
                                            {{ old('theme', $resume->theme ?? 'professional_blue') === 'professional_blue' ? 'checked' : '' }}
                                        >

                                        <span>
                                            <span class="block font-bold text-ink">
                                                Professional Blue
                                            </span>

                                            <span class="block text-sm text-muted mt-1">
                                                A clean professional theme with blue accents.
                                            </span>

                                            <span class="block mt-3 h-2 rounded-full bg-linear-to-r from-slate-900 via-blue-700 to-blue-400"></span>
                                        </span>
                                    </label>

                                    <!-- Dark Modern -->
                                    <label class="flex items-start gap-3 rounded-xl border border-line bg-surface-soft p-4 cursor-pointer hover:bg-surface-soft hover:border-line transition">
                                        <input
                                            type="radio"
                                            name="theme"
                                            value="dark_modern"
                                            class="mt-1"
                                            {{ old('theme', $resume->theme ?? 'professional_blue') === 'dark_modern' ? 'checked' : '' }}
                                        >

                                        <span>
                                            <span class="block font-bold text-ink">
                                                Dark Modern
                                            </span>

                                            <span class="block text-sm text-muted mt-1">
                                                A strong dark theme for modern technical resumes.
                                            </span>

                                            <span class="block mt-3 h-2 rounded-full bg-linear-to-r from-black via-slate-800 to-cyan-500"></span>
                                        </span>
                                    </label>

                                    <!-- Minimal Light -->
                                    <label class="flex items-start gap-3 rounded-xl border border-line bg-surface-soft p-4 cursor-pointer hover:bg-surface-soft hover:border-line transition">
                                        <input
                                            type="radio"
                                            name="theme"
                                            value="minimal_light"
                                            class="mt-1"
                                            {{ old('theme', $resume->theme ?? 'professional_blue') === 'minimal_light' ? 'checked' : '' }}
                                        >

                                        <span>
                                            <span class="block font-bold text-ink">
                                                Minimal Light
                                            </span>

                                            <span class="block text-sm text-muted mt-1">
                                                A simple light theme for formal and academic resumes.
                                            </span>

                                            <span class="block mt-3 h-2 rounded-full bg-linear-to-r from-white via-slate-200 to-slate-500 border border-line"></span>
                                        </span>
                                    </label>
                                </div>

                                @error('theme')
                                    <p class="text-red-strong text-sm mt-3">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>
                    </section>

                    <!-- Skills -->
                    <section class="border border-line rounded-xl p-4 sm:p-5 bg-surface shadow-xs">


                        <div>
                            @include('user.resumes.partials.skills')
                        </div>
                    </section>

                    <!-- Languages -->
                    <section class="border border-line rounded-xl p-4 sm:p-5 bg-surface shadow-xs">


                        <div>
                            @include('user.resumes.partials.languages')
                        </div>
                    </section>

                    <!-- Hobbies and Interests -->
                    <section class="border border-line rounded-xl p-4 sm:p-5 bg-surface shadow-xs">


                        <div>
                            @include('user.resumes.partials.interests')
                        </div>
                    </section>

                    <!-- Education -->
                    <section class="border border-line rounded-xl p-4 sm:p-5 bg-surface shadow-xs">


                        <div>
                            @include('user.resumes.partials.educations')
                        </div>
                    </section>

                    <!-- Experience -->
                    <section class="border border-line rounded-xl p-4 sm:p-5 bg-surface shadow-xs">


                        <div>
                            @include('user.resumes.partials.experiences')
                        </div>
                    </section>

                    <!-- Projects -->
                    <section class="border border-line rounded-xl p-4 sm:p-5 bg-surface shadow-xs">


                        <div>
                            @include('user.resumes.partials.projects')
                        </div>
                    </section>

                    <!-- Certificates -->
                    <section class="border border-line rounded-xl p-4 sm:p-5 bg-surface shadow-xs">


                        <div>
                            @include('user.resumes.partials.certificates')
                        </div>
                    </section>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-3 pt-6 border-t border-line">
                        <a href="{{ route('user.resumes.index') }}"
                           class="w-full sm:w-auto inline-flex justify-center px-5 py-2.5 bg-slate-700 text-white rounded-md hover:bg-slate-800 font-semibold">
                            Cancel
                        </a>

                        <button type="submit"
                                class="w-full sm:w-auto inline-flex justify-center px-5 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                            Update Resume
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @include('user.resumes.partials.form-scripts')
</x-app-layout>