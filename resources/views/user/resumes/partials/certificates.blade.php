<!-- Certificates / Courses Section -->
<div class="space-y-5">

    <!-- Section Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
        <div>
            <h3 class="text-lg font-extrabold text-slate-900">
                Certificates / Courses
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Add certificates, course credentials, uploaded files, and related project evidence.
            </p>
        </div>

        <button type="button"
                onclick="addCertificate()"
                class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold">
            + Add Certificate
        </button>
    </div>

    <!-- Certificates Wrapper -->
    <div id="certificates-wrapper" class="space-y-4">

        @if (isset($resume) && $resume->certificates->count())
            @foreach ($resume->certificates as $index => $certificate)
                <div class="certificate-item bg-slate-50 border-2 border-slate-200 rounded-lg p-4">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                        <div>
                            <p class="font-bold text-slate-900">
                                Certificate Item #{{ $index + 1 }}
                            </p>

                            <p class="text-sm text-slate-500">
                                Title, issuer, credential, file, description, and related project.
                            </p>
                        </div>

                        <button type="button"
                                onclick="this.closest('.certificate-item').remove()"
                                class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                            Remove
                        </button>
                    </div>

                    <input type="hidden"
                           name="certificates[{{ $index }}][existing_certificate_file]"
                           value="{{ $certificate->certificate_file }}">

                    <div class="space-y-4">

                        <!-- Certificate Title -->
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">
                                Certificate / Course Title
                            </label>

                            <input type="text"
                                   name="certificates[{{ $index }}][certificate_title]"
                                   value="{{ old('certificates.' . $index . '.certificate_title', $certificate->certificate_title) }}"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Professional Certificate">
                        </div>

                        <!-- Issuer and Issue Date -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 font-bold text-slate-800">
                                    Issuer
                                </label>

                                <input type="text"
                                       name="certificates[{{ $index }}][issuer]"
                                       value="{{ old('certificates.' . $index . '.issuer', $certificate->issuer) }}"
                                       class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Example: Certificate Provider">
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-slate-800">
                                    Issue Date
                                </label>

                                <input type="date"
                                       name="certificates[{{ $index }}][issue_date]"
                                       value="{{ old('certificates.' . $index . '.issue_date', $certificate->issue_date) }}"
                                       class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <!-- Credential ID and URL -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 font-bold text-slate-800">
                                    Credential ID
                                </label>

                                <input type="text"
                                       name="certificates[{{ $index }}][credential_id]"
                                       value="{{ old('certificates.' . $index . '.credential_id', $certificate->credential_id) }}"
                                       class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Example: ABCD-1234">
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-slate-800">
                                    Credential URL
                                </label>

                                <input type="url"
                                       name="certificates[{{ $index }}][credential_url]"
                                       value="{{ old('certificates.' . $index . '.credential_url', $certificate->credential_url) }}"
                                       class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="https://example.com/verify/...">
                            </div>
                        </div>

                        <!-- Certificate File -->
                        <div class="bg-white border border-slate-200 rounded-md p-4">
                            <label class="block mb-2 font-bold text-slate-800">
                                Certificate File / Image
                            </label>

                            <input type="file"
                                   name="certificates[{{ $index }}][certificate_file]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   accept=".pdf,.jpg,.jpeg,.png,.webp">

                            <p class="text-sm text-slate-500 mt-2">
                                Upload certificate image or PDF.
                            </p>

                            @if ($certificate->certificate_file)
                                <div class="mt-3 bg-slate-50 border border-slate-200 rounded-md p-3">
                                    <p class="text-sm text-slate-700">
                                        Current file:
                                        <a href="{{ asset('storage/' . $certificate->certificate_file) }}"
                                           target="_blank"
                                           class="text-blue-600 hover:underline font-semibold">
                                            View uploaded certificate
                                        </a>
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">
                                Description
                            </label>

                            <textarea name="certificates[{{ $index }}][description]"
                                      rows="3"
                                      class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                      placeholder="Describe what you learned or achieved.">{{ old('certificates.' . $index . '.description', $certificate->description) }}</textarea>
                        </div>

                        <!-- Related Project -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 font-bold text-slate-800">
                                    Related Project Title
                                </label>

                                <input type="text"
                                       name="certificates[{{ $index }}][related_project_title]"
                                       value="{{ old('certificates.' . $index . '.related_project_title', $certificate->related_project_title) }}"
                                       class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Example: Portfolio Project">
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-slate-800">
                                    Related Project Link
                                </label>

                                <input type="url"
                                       name="certificates[{{ $index }}][related_project_link]"
                                       value="{{ old('certificates.' . $index . '.related_project_link', $certificate->related_project_link) }}"
                                       class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="https://example.com/project">
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        @else
            <div class="certificate-item bg-slate-50 border-2 border-slate-200 rounded-lg p-4">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-slate-900">
                            Certificate Item #1
                        </p>

                        <p class="text-sm text-slate-500">
                            Title, issuer, credential, file, description, and related project.
                        </p>
                    </div>

                    <button type="button"
                            onclick="this.closest('.certificate-item').remove()"
                            class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                        Remove
                    </button>
                </div>

                <div class="space-y-4">

                    <!-- Certificate Title -->
                    <div>
                        <label class="block mb-2 font-bold text-slate-800">
                            Certificate / Course Title
                        </label>

                        <input type="text"
                               name="certificates[0][certificate_title]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Professional Certificate">
                    </div>

                    <!-- Issuer and Issue Date -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">
                                Issuer
                            </label>

                            <input type="text"
                                   name="certificates[0][issuer]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Certificate Provider">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-slate-800">
                                Issue Date
                            </label>

                            <input type="date"
                                   name="certificates[0][issue_date]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <!-- Credential ID and URL -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">
                                Credential ID
                            </label>

                            <input type="text"
                                   name="certificates[0][credential_id]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: ABCD-1234">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-slate-800">
                                Credential URL
                            </label>

                            <input type="url"
                                   name="certificates[0][credential_url]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="https://example.com/verify/...">
                        </div>
                    </div>

                    <!-- Certificate File -->
                    <div class="bg-white border border-slate-200 rounded-md p-4">
                        <label class="block mb-2 font-bold text-slate-800">
                            Certificate File / Image
                        </label>

                        <input type="file"
                               name="certificates[0][certificate_file]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               accept=".pdf,.jpg,.jpeg,.png,.webp">

                        <p class="text-sm text-slate-500 mt-2">
                            Upload certificate image or PDF.
                        </p>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block mb-2 font-bold text-slate-800">
                            Description
                        </label>

                        <textarea name="certificates[0][description]"
                                  rows="3"
                                  class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Describe what you learned or achieved."></textarea>
                    </div>

                    <!-- Related Project -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">
                                Related Project Title
                            </label>

                            <input type="text"
                                   name="certificates[0][related_project_title]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Portfolio Project">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-slate-800">
                                Related Project Link
                            </label>

                            <input type="url"
                                   name="certificates[0][related_project_link]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="https://example.com/project">
                        </div>
                    </div>

                </div>
            </div>
        @endif

    </div>
</div>