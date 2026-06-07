<!-- Hobbies & Interests Section -->
<div class="space-y-5">

    <!-- Section Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
        <div>
            <h3 class="text-lg font-extrabold text-slate-900">
                Hobbies & Interests
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Add optional interests that support your professional profile.
            </p>
        </div>

        <button type="button"
                onclick="addInterest()"
                class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold">
            + Add Interest
        </button>
    </div>

    <!-- Interests Wrapper -->
    <div id="interests-wrapper" class="space-y-4">

        @if (isset($resume) && $resume->interests->count())
            @foreach ($resume->interests as $index => $interest)
                <div class="interest-item bg-slate-50 border-2 border-slate-200 rounded-lg p-4">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                        <div>
                            <p class="font-bold text-slate-900">
                                Interest Item #{{ $index + 1 }}
                            </p>

                            <p class="text-sm text-slate-500">
                                Hobby or interest with optional description.
                            </p>
                        </div>

                        <button type="button"
                                onclick="this.closest('.interest-item').remove()"
                                class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                            Remove
                        </button>
                    </div>

                    <div class="space-y-4">

                        <!-- Interest Name -->
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">
                                Interest / Hobby Name
                            </label>

                            <input type="text"
                                   name="interests[{{ $index }}][interest_name]"
                                   value="{{ old('interests.' . $index . '.interest_name', $interest->interest_name) }}"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Artificial Intelligence">
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">
                                Description
                            </label>

                            <textarea name="interests[{{ $index }}][description]"
                                      rows="3"
                                      class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                      placeholder="Example: Interested in applying AI tools to real-world software and data analysis problems.">{{ old('interests.' . $index . '.description', $interest->description) }}</textarea>
                        </div>

                    </div>
                </div>
            @endforeach
        @else
            <div class="interest-item bg-slate-50 border-2 border-slate-200 rounded-lg p-4">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-slate-900">
                            Interest Item #1
                        </p>

                        <p class="text-sm text-slate-500">
                            Hobby or interest with optional description.
                        </p>
                    </div>

                    <button type="button"
                            onclick="this.closest('.interest-item').remove()"
                            class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                        Remove
                    </button>
                </div>

                <div class="space-y-4">

                    <!-- Interest Name -->
                    <div>
                        <label class="block mb-2 font-bold text-slate-800">
                            Interest / Hobby Name
                        </label>

                        <input type="text"
                               name="interests[0][interest_name]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Artificial Intelligence">
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block mb-2 font-bold text-slate-800">
                            Description
                        </label>

                        <textarea name="interests[0][description]"
                                  rows="3"
                                  class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Example: Interested in applying AI tools to real-world software and data analysis problems."></textarea>
                    </div>

                </div>
            </div>
        @endif

    </div>
</div>