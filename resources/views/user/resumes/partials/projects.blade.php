<!-- Projects Section -->
<div class="space-y-5">

    <!-- Section Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 bg-surface-soft border border-line rounded-xl p-4">
        <div>
            <h3 class="text-lg font-bold text-ink">
                Projects
            </h3>

            <p class="text-sm text-muted mt-1">
                Add portfolio projects, descriptions, technologies, and useful links.
            </p>
        </div>

        <button type="button"
                onclick="addProject()"
                class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold">
            + Add Project
        </button>
    </div>

    <!-- Projects Wrapper -->
    <div id="projects-wrapper" class="space-y-4">

        @php
            $projects = session()->hasOldInput()
                ? collect(old('projects', []))->map(fn ($row) => (object) $row)
                : (isset($resume) ? $resume->projects : collect([(object) []]));
        @endphp
        @foreach ($projects as $index => $project)
                <div class="project-item bg-surface-soft border border-line rounded-xl p-4">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                        <div>
                            <p class="font-bold text-ink">
                                Project Item #{{ $index + 1 }}
                            </p>

                            <p class="text-sm text-muted">
                                Project title, description, and external link.
                            </p>
                        </div>

                        <button type="button"
                                onclick="this.closest('.project-item').remove()"
                                class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                            Remove
                        </button>
                    </div>

                    <div class="space-y-4">

                        <!-- Project Title -->
                        <div>
                            <label class="block mb-2 font-bold text-ink">
                                Project Title
                            </label>

                            <input type="text"
                                   name="projects[{{ $index }}][project_title]"
                                   value="{{ old('projects.' . $index . '.project_title', ($project->project_title ?? null)) }}"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Laravel Resume Management System">
                        </div>

                        <!-- Project Description -->
                        <div>
                            <label class="block mb-2 font-bold text-ink">
                                Project Description
                            </label>

                            <textarea name="projects[{{ $index }}][project_description]"
                                      rows="4"
                                      class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                      placeholder="Describe the project, technologies, features, and your role.">{{ old('projects.' . $index . '.project_description', ($project->project_description ?? null)) }}</textarea>
                        </div>

                        <!-- Project Link -->
                        <div>
                            <label class="block mb-2 font-bold text-ink">
                                Project Link
                            </label>

                            <input type="url"
                                   name="projects[{{ $index }}][project_link]"
                                   value="{{ old('projects.' . $index . '.project_link', ($project->project_link ?? null)) }}"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="https://github.com/username/project">
                        </div>

                    </div>
                </div>
            @endforeach


    </div>
</div>