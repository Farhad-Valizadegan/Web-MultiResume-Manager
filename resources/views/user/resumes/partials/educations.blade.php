<!-- Education Section -->
<div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 border-b pb-2 mb-4">
        <h3 class="text-lg font-bold">Education</h3>

        <button type="button"
                onclick="addEducation()"
                class="w-full sm:w-auto px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            + Add Education
        </button>
    </div>

    <div id="educations-wrapper">
        @if (isset($resume) && $resume->educations->count())
            @foreach ($resume->educations as $index => $education)
                <div class="education-item border rounded p-4 mb-4">
                    <div class="flex justify-end mb-2">
                        <button type="button"
                                onclick="this.closest('.education-item').remove()"
                                class="text-red-600 hover:underline">
                            Remove
                        </button>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Institution Name</label>
                        <input type="text"
                               name="educations[{{ $index }}][institution_name]"
                               value="{{ old('educations.' . $index . '.institution_name', $education->institution_name) }}"
                               class="w-full border-gray-300 rounded"
                               placeholder="Example: University Name">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-1 font-medium">Degree</label>
                            <input type="text"
                                   name="educations[{{ $index }}][degree]"
                                   value="{{ old('educations.' . $index . '.degree', $education->degree) }}"
                                   class="w-full border-gray-300 rounded"
                                   placeholder="Example: M.Sc.">
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 font-medium">Field of Study</label>
                            <input type="text"
                                   name="educations[{{ $index }}][field_of_study]"
                                   value="{{ old('educations.' . $index . '.field_of_study', $education->field_of_study) }}"
                                   class="w-full border-gray-300 rounded"
                                   placeholder="Example: Computer Science">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-1 font-medium">Start Date</label>
                            <input type="date"
                                   name="educations[{{ $index }}][start_date]"
                                   value="{{ old('educations.' . $index . '.start_date', $education->start_date) }}"
                                   class="w-full border-gray-300 rounded">
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 font-medium">End Date</label>
                            <input type="date"
                                   name="educations[{{ $index }}][end_date]"
                                   value="{{ old('educations.' . $index . '.end_date', $education->end_date) }}"
                                   class="w-full border-gray-300 rounded">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Description</label>
                        <textarea name="educations[{{ $index }}][description]"
                                  rows="3"
                                  class="w-full border-gray-300 rounded"
                                  placeholder="Example: Focused on software engineering, data science, machine learning, and applied computer science.">{{ old('educations.' . $index . '.description', $education->description) }}</textarea>
                    </div>
                </div>
            @endforeach
        @else
            <div class="education-item border rounded p-4 mb-4">
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Institution Name</label>
                    <input type="text"
                           name="educations[0][institution_name]"
                           class="w-full border-gray-300 rounded"
                           placeholder="Example: University Name">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Degree</label>
                        <input type="text"
                               name="educations[0][degree]"
                               class="w-full border-gray-300 rounded"
                               placeholder="Example: M.Sc.">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Field of Study</label>
                        <input type="text"
                               name="educations[0][field_of_study]"
                               class="w-full border-gray-300 rounded"
                               placeholder="Example: Computer Science">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Start Date</label>
                        <input type="date"
                               name="educations[0][start_date]"
                               class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">End Date</label>
                        <input type="date"
                               name="educations[0][end_date]"
                               class="w-full border-gray-300 rounded">
                    </div>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Description</label>
                    <textarea name="educations[0][description]"
                              rows="3"
                              class="w-full border-gray-300 rounded"
                              placeholder="Example: Focused on software engineering, data analysis, databases, and web development."></textarea>
                </div>
            </div>
        @endif
    </div>
</div>