<!-- Skills Section -->
<div class="space-y-5">

    <!-- Section Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
        <div>
            <h3 class="text-lg font-extrabold text-slate-900">
                Skills
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Add your skills by category, name, and proficiency level.
            </p>
        </div>

        <button type="button"
                onclick="addSkill()"
                class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold">
            + Add Skill
        </button>
    </div>

    <!-- Skills Wrapper -->
    <div id="skills-wrapper" class="space-y-4">

        @if (isset($resume) && $resume->skills->count())
            @foreach ($resume->skills as $index => $skill)
                <div class="skill-item bg-slate-50 border-2 border-slate-200 rounded-lg p-4">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                        <div>
                            <p class="font-bold text-slate-900">
                                Skill Item #{{ $index + 1 }}
                            </p>

                            <p class="text-sm text-slate-500">
                                Category, skill name, and level.
                            </p>
                        </div>

                        <button type="button"
                                onclick="this.closest('.skill-item').remove()"
                                class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                            Remove
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <!-- Skill Category -->
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">
                                Skill Category
                            </label>

                            <input type="text"
                                   name="skills[{{ $index }}][skill_category]"
                                   value="{{ old('skills.' . $index . '.skill_category', $skill->skill_category) }}"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Programming">
                        </div>

                        <!-- Skill Name -->
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">
                                Skill Name
                            </label>

                            <input type="text"
                                   name="skills[{{ $index }}][skill_name]"
                                   value="{{ old('skills.' . $index . '.skill_name', $skill->skill_name) }}"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Python">
                        </div>

                        <!-- Skill Level -->
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">
                                Skill Level
                            </label>

                            <input type="text"
                                   name="skills[{{ $index }}][skill_level]"
                                   value="{{ old('skills.' . $index . '.skill_level', $skill->skill_level) }}"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Intermediate">
                        </div>

                    </div>
                </div>
            @endforeach
        @else
            <div class="skill-item bg-slate-50 border-2 border-slate-200 rounded-lg p-4">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-slate-900">
                            Skill Item #1
                        </p>

                        <p class="text-sm text-slate-500">
                            Category, skill name, and level.
                        </p>
                    </div>

                    <button type="button"
                            onclick="this.closest('.skill-item').remove()"
                            class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                        Remove
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <!-- Skill Category -->
                    <div>
                        <label class="block mb-2 font-bold text-slate-800">
                            Skill Category
                        </label>

                        <input type="text"
                               name="skills[0][skill_category]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Programming">
                    </div>

                    <!-- Skill Name -->
                    <div>
                        <label class="block mb-2 font-bold text-slate-800">
                            Skill Name
                        </label>

                        <input type="text"
                               name="skills[0][skill_name]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Python">
                    </div>

                    <!-- Skill Level -->
                    <div>
                        <label class="block mb-2 font-bold text-slate-800">
                            Skill Level
                        </label>

                        <input type="text"
                               name="skills[0][skill_level]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Intermediate">
                    </div>

                </div>
            </div>
        @endif

    </div>
</div>