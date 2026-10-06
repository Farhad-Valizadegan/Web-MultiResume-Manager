<!-- Basic Resume Information -->
<div class="space-y-6">

    <!-- Resume Title and Target Position -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <!-- Resume Title -->
        <div>
            <label for="title" class="block mb-2 font-bold text-ink">
                Resume Title
                <span class="text-red-strong">*</span>
            </label>

            <input id="title"
                   type="text"
                   name="title"
                   value="{{ old('title', $resume->title ?? '') }}"
                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                   placeholder="Example: Data Analyst Resume"
                   required>

            <p class="text-sm text-muted mt-2">
                Internal title for identifying this resume in your dashboard.
            </p>

            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <!-- Target Job Position -->
        <div>
            <label for="job_position" class="block mb-2 font-bold text-ink">
                Target Job Position
            </label>

            <input id="job_position"
                   type="text"
                   name="job_position"
                   value="{{ old('job_position', $resume->job_position ?? '') }}"
                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                   placeholder="Example: Junior Web Developer">

            <p class="text-sm text-muted mt-2">
                This position appears as the main title on the public resume page.
            </p>

            <x-input-error class="mt-2" :messages="$errors->get('job_position')" />
        </div>

    </div>

    <!-- Resume-Specific Personal Information -->
    <div class="bg-surface-soft border border-line rounded-xl p-5 space-y-5">

        <div>
            <h3 class="text-lg font-bold text-ink">
                Personal and Contact Information
            </h3>

            <p class="text-sm text-muted mt-1">
                This information belongs only to this resume and may be different
                from your account profile.
            </p>
        </div>

        <!-- Full Name and Contact Email -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <label for="full_name" class="block mb-2 font-bold text-ink">
                    Full Name
                </label>

                <input id="full_name"
                       type="text"
                       name="full_name"
                       value="{{ old('full_name', $resume->full_name ?? '') }}"
                       class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500"
                       placeholder="Example: Farhad Valizadegan">

                <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
            </div>

            <div>
                <label for="email" class="block mb-2 font-bold text-ink">
                    Contact Email
                </label>

                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email', $resume->email ?? '') }}"
                       class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500"
                       placeholder="Example: farhad@example.com">

                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

        </div>

        <!-- Phone and Website -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <label for="phone" class="block mb-2 font-bold text-ink">
                    Phone Number
                </label>

                <input id="phone"
                       type="text"
                       name="phone"
                       value="{{ old('phone', $resume->phone ?? '') }}"
                       class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500"
                       placeholder="Example: +49 123 456789">

                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <div>
                <label for="website" class="block mb-2 font-bold text-ink">
                    Website or Portfolio
                </label>

                <input id="website"
                       type="url"
                       name="website"
                       value="{{ old('website', $resume->website ?? '') }}"
                       class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500"
                       placeholder="https://example.com">

                <x-input-error class="mt-2" :messages="$errors->get('website')" />
            </div>

        </div>

        <!-- Street Address -->
        <div>
            <label for="address" class="block mb-2 font-bold text-ink">
                Street Address
            </label>

            <textarea id="address"
                      name="address"
                      rows="2"
                      class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500"
                      placeholder="Example: Musterstraße 10">{{ old('address', $resume->address ?? '') }}</textarea>

            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <!-- Postal Code, City, and Country -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <div>
                <label for="postal_code" class="block mb-2 font-bold text-ink">
                    Postal Code
                </label>

                <input id="postal_code"
                       type="text"
                       name="postal_code"
                       value="{{ old('postal_code', $resume->postal_code ?? '') }}"
                       class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500"
                       placeholder="Example: 91052">

                <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
            </div>

            <div>
                <label for="city" class="block mb-2 font-bold text-ink">
                    City
                </label>

                <input id="city"
                       type="text"
                       name="city"
                       value="{{ old('city', $resume->city ?? '') }}"
                       class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500"
                       placeholder="Example: Erlangen">

                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <div>
                <label for="country" class="block mb-2 font-bold text-ink">
                    Country
                </label>

                <input id="country"
                       type="text"
                       name="country"
                       value="{{ old('country', $resume->country ?? '') }}"
                       class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500"
                       placeholder="Example: Germany">

                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>

        </div>

        <!-- LinkedIn and GitHub -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <label for="linkedin" class="block mb-2 font-bold text-ink">
                    LinkedIn URL
                </label>

                <input id="linkedin"
                       type="url"
                       name="linkedin"
                       value="{{ old('linkedin', $resume->linkedin ?? '') }}"
                       class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500"
                       placeholder="https://www.linkedin.com/in/username">

                <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
            </div>

            <div>
                <label for="github" class="block mb-2 font-bold text-ink">
                    GitHub URL
                </label>

                <input id="github"
                       type="url"
                       name="github"
                       value="{{ old('github', $resume->github ?? '') }}"
                       class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500"
                       placeholder="https://github.com/username">

                <x-input-error class="mt-2" :messages="$errors->get('github')" />
            </div>

        </div>

        <!-- Professional Summary -->
        <div>
            <label for="professional_summary" class="block mb-2 font-bold text-ink">
                Professional Summary
            </label>

            <textarea id="professional_summary"
                      name="professional_summary"
                      rows="5"
                      class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500"
                      placeholder="Write a concise professional summary tailored to this resume.">{{ old('professional_summary', $resume->professional_summary ?? '') }}</textarea>

            <x-input-error
                class="mt-2"
                :messages="$errors->get('professional_summary')" />
        </div>

        <!-- Resume Profile Photo -->
        <div>
            <label for="profile_photo" class="block mb-2 font-bold text-ink">
                Resume Profile Photo
            </label>

            @if (isset($resume) && $resume->profile_photo)
                <div class="mb-4 flex flex-col sm:flex-row sm:items-center gap-4">

                    <img src="{{ route('resume.files.show', [$resume, 'photo']) }}"
                         alt="{{ $resume->full_name ?: 'Resume profile photo' }}"
                         class="w-28 h-28 rounded-xl object-cover border border-line shadow-xs">

                    <label class="inline-flex items-center gap-2 text-sm font-semibold text-red-strong">
                        <input type="checkbox"
                               name="remove_profile_photo"
                               value="1"
                               @checked(old('remove_profile_photo'))
                               class="rounded-sm border-line text-red-strong focus:ring-red-500">

                        Remove the current photo
                    </label>

                </div>
            @endif

            <input id="profile_photo"
                   type="file"
                   name="profile_photo"
                   accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                   class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500">

            <p class="text-sm text-muted mt-2">
                Upload a JPG, PNG, or WebP image. Maximum file size: 2 MB.

                @if (isset($resume) && $resume->profile_photo)
                    Uploading a new photo will replace the current one.
                @endif
            </p>

            <x-input-error
                class="mt-2"
                :messages="$errors->get('profile_photo')" />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('remove_profile_photo')" />
        </div>

    </div>

    <!-- Public Resume Password: Create Only -->
    @if (!isset($resume))
        <div class="bg-surface-soft border border-line rounded-xl p-4">

            <label for="resume_password" class="block mb-2 font-bold text-ink">
                Public Resume Password
            </label>

            <input id="resume_password"
                   type="password"
                   name="resume_password"
                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                   placeholder="Minimum 6 characters">

            <p class="text-sm text-muted mt-2">
                Leave blank for public access, or set a password to restrict access.
                You can change it later.
            </p>

            <x-input-error
                class="mt-2"
                :messages="$errors->get('resume_password')" />

        </div>
    @endif

    <!-- Resume Status: Edit Only -->
    @if (isset($resume))
        <div class="bg-surface-soft border border-line rounded-xl p-4">

            <label for="status" class="block mb-2 font-bold text-ink">
                Resume Status
            </label>

            <select id="status"
                    name="status"
                    class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                    required>

                <option value="active"
                        {{ old('status', $resume->status) === 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="inactive"
                        {{ old('status', $resume->status) === 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

            <p class="text-sm text-muted mt-2">
                Active resumes can be opened through their public link.
                Inactive resumes are not publicly accessible.
            </p>

            <x-input-error
                class="mt-2"
                :messages="$errors->get('status')" />

        </div>
    @endif

    <!-- Download and Upload Settings -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

        <!-- Download Resume Type -->
        <div class="bg-surface-soft border border-line rounded-xl p-4">

            <label for="download_resume_type" class="block mb-2 font-bold text-ink">
                Download Resume Type
                <span class="text-red-strong">*</span>
            </label>

            <select id="download_resume_type"
                    name="download_resume_type"
                    class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                    required>

                <option value="generated"
                        {{ old('download_resume_type', $resume->download_resume_type ?? 'generated') === 'generated' ? 'selected' : '' }}>
                    Generated Resume PDF only
                </option>

                <option value="uploaded"
                        {{ old('download_resume_type', $resume->download_resume_type ?? '') === 'uploaded' ? 'selected' : '' }}>
                    Uploaded Resume PDF only
                </option>

                <option value="both"
                        {{ old('download_resume_type', $resume->download_resume_type ?? '') === 'both' ? 'selected' : '' }}>
                    Both Generated and Uploaded PDF
                </option>

            </select>

            <p class="text-sm text-muted mt-2">
                Choose what employers can download from the public resume page.
            </p>

            <x-input-error
                class="mt-2"
                :messages="$errors->get('download_resume_type')" />

        </div>

        <!-- Uploaded Resume PDF -->
        <div class="bg-surface-soft border border-line rounded-xl p-4">

            <label for="uploaded_resume_file" class="block mb-2 font-bold text-ink">
                Upload Your Own Resume PDF
            </label>

            <input id="uploaded_resume_file"
                   type="file"
                   name="uploaded_resume_file"
                   accept=".pdf,application/pdf"
                   class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500">

            <p class="text-sm text-muted mt-2">
                Optional if you choose generated PDF only.
                Required if you choose uploaded PDF or both.
            </p>

            @if (isset($resume) && $resume->uploaded_resume_file)
                <div class="mt-3 bg-surface border border-line rounded-md p-3">

                    <p class="text-sm text-muted">
                        Current uploaded resume:

                        <a href="{{ route('resume.files.show', [$resume, 'uploaded']) }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="text-blue-strong hover:underline font-semibold">
                            View uploaded PDF
                        </a>
                    </p>

                </div>
            @endif

            <x-input-error
                class="mt-2"
                :messages="$errors->get('uploaded_resume_file')" />

        </div>

    </div>

</div>