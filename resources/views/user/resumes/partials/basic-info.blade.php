<!-- Basic Resume Information -->
<div class="space-y-6">

    <!-- Resume Title and Target Position -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <!-- Resume Title -->
        <div>
            <label for="title" class="block mb-2 font-bold text-slate-800">
                Resume Title
                <span class="text-red-600">*</span>
            </label>

            <input id="title"
                   type="text"
                   name="title"
                   value="{{ old('title', $resume->title ?? '') }}"
                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   placeholder="Example: Data Analyst Resume"
                   required>

            <p class="text-sm text-slate-500 mt-2">
                Internal title for identifying this resume in your dashboard.
            </p>

            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <!-- Target Job Position -->
        <div>
            <label for="job_position" class="block mb-2 font-bold text-slate-800">
                Target Job Position
            </label>

            <input id="job_position"
                   type="text"
                   name="job_position"
                   value="{{ old('job_position', $resume->job_position ?? '') }}"
                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   placeholder="Example: Junior Web Developer">

            <p class="text-sm text-slate-500 mt-2">
                This position appears as the main title on the public resume page.
            </p>

            <x-input-error class="mt-2" :messages="$errors->get('job_position')" />
        </div>

    </div>

    <!-- Public Resume Password only for Create -->
    @if (!isset($resume))
        <div class="bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
            <label for="resume_password" class="block mb-2 font-bold text-slate-800">
                Public Resume Password
            </label>

            <input id="resume_password"
                   type="password"
                   name="resume_password"
                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   placeholder="Minimum 6 characters">

            <p class="text-sm text-slate-500 mt-2">
                Employers need this password to view the public resume. You can change it later.
            </p>

            <x-input-error class="mt-2" :messages="$errors->get('resume_password')" />
        </div>
    @endif

    <!-- Status only for Edit -->
    @if (isset($resume))
        <div class="bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
            <label for="status" class="block mb-2 font-bold text-slate-800">
                Resume Status
            </label>

            <select id="status"
                    name="status"
                    class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>
                <option value="active" {{ old('status', $resume->status) === 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="inactive" {{ old('status', $resume->status) === 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>

            <p class="text-sm text-slate-500 mt-2">
                Active resumes can be opened through their public link. Inactive resumes are not publicly accessible.
            </p>

            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>
    @endif

    <!-- Download and Upload Settings -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

        <!-- Download Resume Type -->
        <div class="bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
            <label for="download_resume_type" class="block mb-2 font-bold text-slate-800">
                Download Resume Type
                <span class="text-red-600">*</span>
            </label>

            <select id="download_resume_type"
                    name="download_resume_type"
                    class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
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

            <p class="text-sm text-slate-500 mt-2">
                Choose what employers can download from the public resume page.
            </p>

            <x-input-error class="mt-2" :messages="$errors->get('download_resume_type')" />
        </div>

        <!-- Uploaded Resume File -->
        <div class="bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
            <label for="uploaded_resume_file" class="block mb-2 font-bold text-slate-800">
                Upload Your Own Resume PDF
            </label>

            <input id="uploaded_resume_file"
                   type="file"
                   name="uploaded_resume_file"
                   accept=".pdf"
                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500">

            <p class="text-sm text-slate-500 mt-2">
                Optional if you choose generated PDF only. Required if you choose uploaded PDF or both.
            </p>

            @if (isset($resume) && $resume->uploaded_resume_file)
                <div class="mt-3 bg-white border border-slate-300 rounded-md p-3">
                    <p class="text-sm text-slate-700">
                        Current uploaded resume:
                        <a href="{{ asset('storage/' . $resume->uploaded_resume_file) }}"
                           target="_blank"
                           class="text-blue-600 hover:underline font-semibold">
                            View uploaded PDF
                        </a>
                    </p>
                </div>
            @endif

            <x-input-error class="mt-2" :messages="$errors->get('uploaded_resume_file')" />
        </div>

    </div>

</div>