<!-- Education Section -->
<div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 border-b pb-2 mb-4">
        <h3 class="text-lg font-bold">Education</h3>

        <button type="button"
                onclick="addEducation()"
                class="w-full sm:w-auto px-3 py-2 bg-green-600 text-white rounded-sm hover:bg-green-700">
            + Add Education
        </button>
    </div>

    <div id="educations-wrapper">
        @php
            $educations = session()->hasOldInput()
                ? collect(old('educations', []))->map(fn ($row) => (object) $row)
                : (isset($resume) ? $resume->educations : collect([(object) []]));
        @endphp
        @foreach ($educations as $index => $education)
                <div class="education-item border rounded-sm p-4 mb-4">
                    <div class="flex justify-end mb-2">
                        <button type="button"
                                onclick="this.closest('.education-item').remove()"
                                class="text-red-strong hover:underline">
                            Remove
                        </button>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Institution Name</label>
                        <input type="text"
                               name="educations[{{ $index }}][institution_name]"
                               value="{{ old('educations.' . $index . '.institution_name', ($education->institution_name ?? null)) }}"
                               class="w-full border-line rounded-sm"
                               placeholder="Example: University Name">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-1 font-medium">Degree</label>
                            <input type="text"
                                   name="educations[{{ $index }}][degree]"
                                   value="{{ old('educations.' . $index . '.degree', ($education->degree ?? null)) }}"
                                   class="w-full border-line rounded-sm"
                                   placeholder="Example: M.Sc.">
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 font-medium">Field of Study</label>
                            <input type="text"
                                   name="educations[{{ $index }}][field_of_study]"
                                   value="{{ old('educations.' . $index . '.field_of_study', ($education->field_of_study ?? null)) }}"
                                   class="w-full border-line rounded-sm"
                                   placeholder="Example: Computer Science">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-1 font-medium">Start month</label>
                            <input type="month"
                                   name="educations[{{ $index }}][start_date]"
                                   value="{{ substr((string) old('educations.' . $index . '.start_date', ($education->start_date ?? '')), 0, 7) }}"
                                   class="w-full border-line rounded-sm">
                            @error('educations.' . $index . '.start_date')<p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 font-medium">End month (leave blank if ongoing)</label>
                            <input type="month"
                                   name="educations[{{ $index }}][end_date]"
                                   value="{{ substr((string) old('educations.' . $index . '.end_date', ($education->end_date ?? '')), 0, 7) }}"
                                   class="w-full border-line rounded-sm">
                            @error('educations.' . $index . '.end_date')<p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Description</label>
                        <textarea name="educations[{{ $index }}][description]"
                                  rows="3"
                                  class="w-full border-line rounded-sm"
                                  placeholder="Example: Focused on software engineering, data science, machine learning, and applied computer science.">{{ old('educations.' . $index . '.description', ($education->description ?? null)) }}</textarea>
                    </div>
                </div>
            @endforeach

    </div>
</div>