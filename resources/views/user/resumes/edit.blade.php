<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Edit Resume
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Update your resume information, public access, skills, education, experience, projects, and certificates.
                </p>
            </div>

            <a href="{{ route('user.resumes.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-slate-800 text-white rounded-md hover:bg-slate-900 font-semibold">
                Back to My Resumes
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gradient-to-br from-slate-900 via-slate-800 to-blue-950">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-slate-300 shadow-2xl sm:rounded-lg p-4 sm:p-6 border-2 border-slate-500">

                <!-- Page Intro -->
                <div class="mb-6 bg-white border-2 border-slate-300 rounded-lg p-5">
                    <h3 class="text-lg font-extrabold text-slate-900">
                        Edit Resume Information
                    </h3>

                    <p class="text-sm text-slate-600 mt-1">
                        You are editing:
                        <span class="font-bold text-slate-900">
                            {{ $resume->title }}
                        </span>
                    </p>
                </div>

                <form method="POST"
                      action="{{ route('user.resumes.update', $resume) }}"
                      enctype="multipart/form-data"
                      class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information -->
                    <section class="border-2 border-slate-300 rounded-lg p-4 sm:p-5 bg-white shadow-sm">
                        <div class="mb-4 bg-slate-100 border border-slate-300 rounded-md p-4">
                            <h4 class="text-base font-extrabold text-slate-900">
                                Basic Information
                            </h4>

                            <p class="text-sm text-slate-600 mt-1">
                                Resume title, target position, public access, and download settings.
                            </p>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-md p-4">
                            @include('user.resumes.partials.basic-info')
                        </div>
                    </section>

                    <!-- Skills -->
                    <section class="border-2 border-slate-300 rounded-lg p-4 sm:p-5 bg-white shadow-sm">
                        <div class="mb-4 bg-slate-100 border border-slate-300 rounded-md p-4">
                            <h4 class="text-base font-extrabold text-slate-900">
                                Skills
                            </h4>

                            <p class="text-sm text-slate-600 mt-1">
                                Update technical and professional skills grouped by category.
                            </p>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-md p-4">
                            @include('user.resumes.partials.skills')
                        </div>
                    </section>

                    <!-- Languages -->
                    <section class="border-2 border-slate-300 rounded-lg p-4 sm:p-5 bg-white shadow-sm">
                        <div class="mb-4 bg-slate-100 border border-slate-300 rounded-md p-4">
                            <h4 class="text-base font-extrabold text-slate-900">
                                Languages
                            </h4>

                            <p class="text-sm text-slate-600 mt-1">
                                Update languages and proficiency levels.
                            </p>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-md p-4">
                            @include('user.resumes.partials.languages')
                        </div>
                    </section>

                    <!-- Hobbies and Interests -->
                    <section class="border-2 border-slate-300 rounded-lg p-4 sm:p-5 bg-white shadow-sm">
                        <div class="mb-4 bg-slate-100 border border-slate-300 rounded-md p-4">
                            <h4 class="text-base font-extrabold text-slate-900">
                                Hobbies & Interests
                            </h4>

                            <p class="text-sm text-slate-600 mt-1">
                                Update optional interests that support your professional profile.
                            </p>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-md p-4">
                            @include('user.resumes.partials.interests')
                        </div>
                    </section>

                    <!-- Education -->
                    <section class="border-2 border-slate-300 rounded-lg p-4 sm:p-5 bg-white shadow-sm">
                        <div class="mb-4 bg-slate-100 border border-slate-300 rounded-md p-4">
                            <h4 class="text-base font-extrabold text-slate-900">
                                Education
                            </h4>

                            <p class="text-sm text-slate-600 mt-1">
                                Update academic background, degrees, fields of study, and descriptions.
                            </p>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-md p-4">
                            @include('user.resumes.partials.educations')
                        </div>
                    </section>

                    <!-- Experience -->
                    <section class="border-2 border-slate-300 rounded-lg p-4 sm:p-5 bg-white shadow-sm">
                        <div class="mb-4 bg-slate-100 border border-slate-300 rounded-md p-4">
                            <h4 class="text-base font-extrabold text-slate-900">
                                Work Experience / Internship
                            </h4>

                            <p class="text-sm text-slate-600 mt-1">
                                Update work experience, internships, companies, dates, and responsibilities.
                            </p>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-md p-4">
                            @include('user.resumes.partials.experiences')
                        </div>
                    </section>

                    <!-- Projects -->
                    <section class="border-2 border-slate-300 rounded-lg p-4 sm:p-5 bg-white shadow-sm">
                        <div class="mb-4 bg-slate-100 border border-slate-300 rounded-md p-4">
                            <h4 class="text-base font-extrabold text-slate-900">
                                Projects
                            </h4>

                            <p class="text-sm text-slate-600 mt-1">
                                Update portfolio projects and useful project links.
                            </p>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-md p-4">
                            @include('user.resumes.partials.projects')
                        </div>
                    </section>

                    <!-- Certificates -->
                    <section class="border-2 border-slate-300 rounded-lg p-4 sm:p-5 bg-white shadow-sm">
                        <div class="mb-4 bg-slate-100 border border-slate-300 rounded-md p-4">
                            <h4 class="text-base font-extrabold text-slate-900">
                                Licenses & Certifications
                            </h4>

                            <p class="text-sm text-slate-600 mt-1">
                                Update certificates, issuers, credential links, and uploaded evidence.
                            </p>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-md p-4">
                            @include('user.resumes.partials.certificates')
                        </div>
                    </section>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-3 pt-6 border-t-2 border-slate-500">
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