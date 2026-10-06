<!-- Skills Section -->
<div class="space-y-5">

    <!-- Section Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 bg-surface-soft border border-line rounded-xl p-4">
        <div>
            <h3 class="text-lg font-bold text-ink">
                Skills
            </h3>

            <p class="text-sm text-muted mt-1">
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

        @php
            $skills = session()->hasOldInput()
                ? collect(old('skills', []))->map(fn ($row) => (object) $row)
                : (isset($resume) ? $resume->skills : collect([(object) []]));
        @endphp
        @foreach ($skills as $index => $skill)
                <div class="skill-item bg-surface-soft border border-line rounded-xl p-4">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                        <div>
                            <p class="font-bold text-ink">
                                Skill Item #{{ $index + 1 }}
                            </p>

                            <p class="text-sm text-muted">
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
                            <label class="block mb-2 font-bold text-ink">
                                Skill Category
                            </label>

                            <input type="text"
                                   name="skills[{{ $index }}][skill_category]"
                                   value="{{ old('skills.' . $index . '.skill_category', ($skill->skill_category ?? null)) }}"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Programming">
                        </div>

                        <!-- Skill Name -->
                        <div>
                            <label class="block mb-2 font-bold text-ink">
                                Skill Name
                            </label>

                            <input type="text"
                                   name="skills[{{ $index }}][skill_name]"
                                   value="{{ old('skills.' . $index . '.skill_name', ($skill->skill_name ?? null)) }}"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Python">
                        </div>

                        <!-- Skill Level -->
                        <div>
                            <label class="block mb-2 font-bold text-ink">
                                Skill Level
                            </label>

                            <input type="text"
                                   name="skills[{{ $index }}][skill_level]"
                                   value="{{ old('skills.' . $index . '.skill_level', ($skill->skill_level ?? null)) }}"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Intermediate">
                        </div>


                        <div class="md:col-span-3">
                            <label for="skill-link-text-{{ $index }}" class="block mb-2 font-bold text-ink">Link text (optional)</label>
                            <input id="skill-link-text-{{ $index }}" type="text" name="skills[{{ $index }}][evidence_label]"
                                   value="{{ old('skills.' . $index . '.evidence_label', $skill->evidence_label ?? '') }}"
                                   maxlength="100" placeholder="Example: Watch my Laravel demo"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                            @error('skills.' . $index . '.evidence_label')<p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
                        </div>
                        <div class="md:col-span-3">
                            <label for="skill-evidence-{{ $index }}" class="block mb-2 font-bold text-ink">Evidence link (optional)</label>
                            <input id="skill-evidence-{{ $index }}" type="url" name="skills[{{ $index }}][evidence_url]"
                                   value="{{ old('skills.' . $index . '.evidence_url', $skill->evidence_url ?? '') }}"
                                   maxlength="2048" placeholder="https://example.com/my-video"
                                   aria-describedby="skill-evidence-help-{{ $index }}"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                            <p id="skill-evidence-help-{{ $index }}" class="mt-2 text-sm text-muted">Link to a video, certificate, or work sample. Visitors can open this link from your resume.</p>
                            @error('skills.' . $index . '.evidence_url')<p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
                        </div>

                    </div>
                </div>
            @endforeach


    </div>
</div>