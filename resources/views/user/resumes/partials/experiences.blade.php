<!-- Work Experience Section -->
<div class="space-y-5">

    <!-- Section Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
        <div>
            <h3 class="text-lg font-extrabold text-slate-900">
                Work Experience / Internship
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Add work experience, internships, company names, dates, and responsibilities.
            </p>
        </div>

        <button type="button"
                onclick="addExperience()"
                class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold">
            + Add Experience
        </button>
    </div>

    <!-- Experiences Wrapper -->
    <div id="experiences-wrapper" class="space-y-4">

        @php
            $experiences = session()->hasOldInput()
                ? collect(old('experiences', []))->map(fn ($row) => (object) $row)
                : (isset($resume) ? $resume->experiences : collect([(object) []]));
        @endphp
        @foreach ($experiences as $index => $experience)
                <div class="experience-item bg-slate-50 border-2 border-slate-200 rounded-lg p-4">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                        <div>
                            <p class="font-bold text-slate-900">
                                Experience Item #{{ $index + 1 }}
                            </p>

                            <p class="text-sm text-slate-500">
                                Company, job title, dates, and responsibilities.
                            </p>
                        </div>

                        <button type="button"
                                onclick="this.closest('.experience-item').remove()"
                                class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                            Remove
                        </button>
                    </div>

                    <div class="space-y-4">

                        <!-- Company and Job Title -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 font-bold text-slate-800">
                                    Company Name
                                </label>

                                <input type="text"
                                       name="experiences[{{ $index }}][company_name]"
                                       value="{{ old('experiences.' . $index . '.company_name', ($experience->company_name ?? null)) }}"
                                       class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Example: Company Name">
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-slate-800">
                                    Job Title / Internship Title
                                </label>

                                <input type="text"
                                       name="experiences[{{ $index }}][job_title]"
                                       value="{{ old('experiences.' . $index . '.job_title', ($experience->job_title ?? null)) }}"
                                       class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Example: Software Developer">
                            </div>
                        </div>

                        <!-- Dates -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 font-bold text-slate-800">
                                    Start Date
                                </label>

                                <input type="date"
                                       name="experiences[{{ $index }}][start_date]"
                                       value="{{ old('experiences.' . $index . '.start_date', ($experience->start_date ?? null)) }}"
                                       class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-slate-800">
                                    End Date
                                </label>

                                <input type="date"
                                       name="experiences[{{ $index }}][end_date]"
                                       value="{{ old('experiences.' . $index . '.end_date', ($experience->end_date ?? null)) }}"
                                       class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">
                                Description
                            </label>

                            <textarea name="experiences[{{ $index }}][description]"
                                      rows="4"
                                      class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                      placeholder="Describe responsibilities, tools, tasks, and achievements.">{{ old('experiences.' . $index . '.description', ($experience->description ?? null)) }}</textarea>
                        </div>

                    </div>
                </div>
            @endforeach


    </div>
</div>