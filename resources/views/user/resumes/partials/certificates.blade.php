<!-- Certificates / Courses Section -->
<div class="space-y-5">

    <!-- Section Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 bg-surface-soft border border-line rounded-xl p-4">
        <div>
            <h3 class="text-lg font-bold text-ink">
                Certificates / Courses
            </h3>

            <p class="text-sm text-muted mt-1">
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

        @php
            $certificates = session()->hasOldInput()
                ? collect(old('certificates', []))->map(fn ($row) => (object) $row)
                : (isset($resume) ? $resume->certificates : collect([(object) []]));
        @endphp
        @foreach ($certificates as $index => $certificate)
                <div class="certificate-item bg-surface-soft border border-line rounded-xl p-4">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                        <div>
                            <p class="font-bold text-ink">
                                Certificate Item #{{ $index + 1 }}
                            </p>

                            <p class="text-sm text-muted">
                                Title, issuer, credential, file, description, and related project.
                            </p>
                        </div>

                        <button type="button"
                                onclick="this.closest('.certificate-item').remove()"
                                class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                            Remove
                        </button>
                    </div>

                    @if (isset($certificate->id))
                    <input type="hidden"
                           name="certificates[{{ $index }}][id]"
                           value="{{ ($certificate->id ?? null) }}">
                    @endif

                    <div class="space-y-4">

                        <!-- Certificate Title -->
                        <div>
                            <label class="block mb-2 font-bold text-ink">
                                Certificate / Course Title
                            </label>

                            <input type="text"
                                   name="certificates[{{ $index }}][certificate_title]"
                                   value="{{ old('certificates.' . $index . '.certificate_title', ($certificate->certificate_title ?? null)) }}"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Professional Certificate">
                        </div>

                        <!-- Issuer and Issue Date -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 font-bold text-ink">
                                    Issuer
                                </label>

                                <input type="text"
                                       name="certificates[{{ $index }}][issuer]"
                                       value="{{ old('certificates.' . $index . '.issuer', ($certificate->issuer ?? null)) }}"
                                       class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Example: Certificate Provider">
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-ink">
                                    Issue Date
                                </label>

                                <input type="date"
                                       name="certificates[{{ $index }}][issue_date]"
                                       value="{{ old('certificates.' . $index . '.issue_date', ($certificate->issue_date ?? null)) }}"
                                       class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <!-- Credential ID and URL -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 font-bold text-ink">
                                    Credential ID
                                </label>

                                <input type="text"
                                       name="certificates[{{ $index }}][credential_id]"
                                       value="{{ old('certificates.' . $index . '.credential_id', ($certificate->credential_id ?? null)) }}"
                                       class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Example: ABCD-1234">
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-ink">
                                    Credential URL
                                </label>

                                <input type="url"
                                       name="certificates[{{ $index }}][credential_url]"
                                       value="{{ old('certificates.' . $index . '.credential_url', ($certificate->credential_url ?? null)) }}"
                                       class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="https://example.com/verify/...">
                            </div>
                        </div>

                        <!-- Certificate File -->
                        <div class="bg-surface border border-line rounded-md p-4">
                            <label class="block mb-2 font-bold text-ink">
                                Certificate File / Image
                            </label>

                            <input type="file"
                                   name="certificates[{{ $index }}][certificate_file]"
                                   class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   accept=".pdf,.jpg,.jpeg,.png,.webp">

                            <p class="text-sm text-muted mt-2">
                                Upload certificate image or PDF.
                            </p>

                            @if (($certificate->certificate_file ?? null))
                                <div class="mt-3 bg-surface-soft border border-line rounded-md p-3">
                                    <p class="text-sm text-muted">
                                        Current file:
                                        <a href="{{ route('resume.files.show', [$resume, 'certificate', ($certificate->id ?? null)]) }}"
                                           target="_blank"
                                           class="text-blue-strong hover:underline font-semibold">
                                            View uploaded certificate
                                        </a>
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block mb-2 font-bold text-ink">
                                Description
                            </label>

                            <textarea name="certificates[{{ $index }}][description]"
                                      rows="3"
                                      class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                      placeholder="Describe what you learned or achieved.">{{ old('certificates.' . $index . '.description', ($certificate->description ?? null)) }}</textarea>
                        </div>

                        <!-- Related Project -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 font-bold text-ink">
                                    Related Project Title
                                </label>

                                <input type="text"
                                       name="certificates[{{ $index }}][related_project_title]"
                                       value="{{ old('certificates.' . $index . '.related_project_title', ($certificate->related_project_title ?? null)) }}"
                                       class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Example: Portfolio Project">
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-ink">
                                    Related Project Link
                                </label>

                                <input type="url"
                                       name="certificates[{{ $index }}][related_project_link]"
                                       value="{{ old('certificates.' . $index . '.related_project_link', ($certificate->related_project_link ?? null)) }}"
                                       class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="https://example.com/project">
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach


    </div>
</div>