<!-- Hobbies & Interests Section -->
<div class="space-y-5">

    <!-- Section Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 bg-surface-soft border border-line rounded-xl p-4">
        <div>
            <h3 class="text-lg font-bold text-ink">
                Hobbies & Interests
            </h3>

            <p class="text-sm text-muted mt-1">
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

        @php
            $interests = session()->hasOldInput()
                ? collect(old('interests', []))->map(fn ($row) => (object) $row)
                : (isset($resume) ? $resume->interests : collect([(object) []]));
        @endphp
        @foreach ($interests as $index => $interest)
                <div class="interest-item bg-surface-soft border border-line rounded-xl p-4">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                        <div>
                            <p class="font-bold text-ink">
                                Interest Item #{{ $index + 1 }}
                            </p>

                            <p class="text-sm text-muted">
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
                            <label class="block mb-2 font-bold text-ink">
                                Interest / Hobby Name
                            </label>

                            <input type="text"
                                   name="interests[{{ $index }}][interest_name]"
                                   value="{{ old('interests.' . $index . '.interest_name', ($interest->interest_name ?? null)) }}"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Artificial Intelligence">
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block mb-2 font-bold text-ink">
                                Description
                            </label>

                            <textarea name="interests[{{ $index }}][description]"
                                      rows="3"
                                      class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                      placeholder="Example: Interested in applying AI tools to real-world software and data analysis problems.">{{ old('interests.' . $index . '.description', ($interest->description ?? null)) }}</textarea>
                        </div>

                    </div>
                </div>
            @endforeach


    </div>
</div>