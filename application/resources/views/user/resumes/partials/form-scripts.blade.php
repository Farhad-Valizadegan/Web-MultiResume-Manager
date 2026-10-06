<script>
    let skillIndex = {{ session()->hasOldInput() ? (count(old('skills', [])) ? max(array_map('intval', array_keys(old('skills', [])))) + 1 : 0) : (isset($resume) ? max($resume->skills->count(), 1) : 1) }};
    let languageIndex = {{ session()->hasOldInput() ? (count(old('languages', [])) ? max(array_map('intval', array_keys(old('languages', [])))) + 1 : 0) : (isset($resume) ? max($resume->languages->count(), 1) : 1) }};
    let interestIndex = {{ session()->hasOldInput() ? (count(old('interests', [])) ? max(array_map('intval', array_keys(old('interests', [])))) + 1 : 0) : (isset($resume) ? max($resume->interests->count(), 1) : 1) }};
    let educationIndex = {{ session()->hasOldInput() ? (count(old('educations', [])) ? max(array_map('intval', array_keys(old('educations', [])))) + 1 : 0) : (isset($resume) ? max($resume->educations->count(), 1) : 1) }};
    let experienceIndex = {{ session()->hasOldInput() ? (count(old('experiences', [])) ? max(array_map('intval', array_keys(old('experiences', [])))) + 1 : 0) : (isset($resume) ? max($resume->experiences->count(), 1) : 1) }};
    let projectIndex = {{ session()->hasOldInput() ? (count(old('projects', [])) ? max(array_map('intval', array_keys(old('projects', [])))) + 1 : 0) : (isset($resume) ? max($resume->projects->count(), 1) : 1) }};
    let certificateIndex = {{ session()->hasOldInput() ? (count(old('certificates', [])) ? max(array_map('intval', array_keys(old('certificates', [])))) + 1 : 0) : (isset($resume) ? max($resume->certificates->count(), 1) : 1) }};

    function removeItem(button, selector) {
        button.closest(selector).remove();
    }

    function addSkill() {
        const wrapper = document.getElementById('skills-wrapper');

        wrapper.insertAdjacentHTML('beforeend', `
            <div class="skill-item bg-surface-soft border border-line rounded-xl p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-ink">
                            Skill Item
                        </p>
                        <p class="text-sm text-muted">
                            Category, skill name, and level.
                        </p>
                    </div>

                    <button type="button"
                            onclick="removeItem(this, '.skill-item')"
                            class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                        Remove
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block mb-2 font-bold text-ink">Skill Category</label>
                        <input type="text"
                               name="skills[${skillIndex}][skill_category]"
                               class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Web Development">
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-ink">Skill Name</label>
                        <input type="text"
                               name="skills[${skillIndex}][skill_name]"
                               class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Laravel">
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-ink">Skill Level</label>
                        <input type="text"
                               name="skills[${skillIndex}][skill_level]"
                               class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Intermediate">
                    </div>

                    <div class="md:col-span-3">
                        <label for="skill-link-text-${skillIndex}" class="block mb-2 font-bold text-ink">Link text (optional)</label>
                        <input id="skill-link-text-${skillIndex}" type="text" name="skills[${skillIndex}][evidence_label]"
                               maxlength="100" placeholder="Example: Watch my Laravel demo"
                               class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-3">
                        <label for="skill-evidence-${skillIndex}" class="block mb-2 font-bold text-ink">Evidence link (optional)</label>
                        <input id="skill-evidence-${skillIndex}" type="url" name="skills[${skillIndex}][evidence_url]"
                               maxlength="2048" placeholder="https://example.com/my-video"
                               aria-describedby="skill-evidence-help-${skillIndex}"
                               class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                        <p id="skill-evidence-help-${skillIndex}" class="mt-2 text-sm text-muted">Link to a video, certificate, or work sample. Visitors can open this link from your resume.</p>
                    </div>

                </div>
            </div>
        `);

        skillIndex++;
    }

    function addLanguage() {
        const wrapper = document.getElementById('languages-wrapper');

        wrapper.insertAdjacentHTML('beforeend', `
            <div class="language-item bg-surface-soft border border-line rounded-xl p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-ink">
                            Language Item
                        </p>
                        <p class="text-sm text-muted">
                            Language name and proficiency level.
                        </p>
                    </div>

                    <button type="button"
                            onclick="removeItem(this, '.language-item')"
                            class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                        Remove
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 font-bold text-ink">Language</label>
                        <input type="text"
                               name="languages[${languageIndex}][language_name]"
                               class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Language Name">
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-ink">Proficiency Level</label>
                        <input type="text"
                               name="languages[${languageIndex}][proficiency_level]"
                               class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Intermediate">
                    </div>
                </div>
            </div>
        `);

        languageIndex++;
    }

    function addInterest() {
        const wrapper = document.getElementById('interests-wrapper');

        wrapper.insertAdjacentHTML('beforeend', `
            <div class="interest-item bg-surface-soft border border-line rounded-xl p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-ink">
                            Interest Item
                        </p>
                        <p class="text-sm text-muted">
                            Hobby or interest with optional description.
                        </p>
                    </div>

                    <button type="button"
                            onclick="removeItem(this, '.interest-item')"
                            class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                        Remove
                    </button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block mb-2 font-bold text-ink">Interest / Hobby Name</label>
                        <input type="text"
                               name="interests[${interestIndex}][interest_name]"
                               class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Open Source">
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-ink">Description</label>
                        <textarea name="interests[${interestIndex}][description]"
                                  rows="3"
                                  class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Example: Interested in learning from open-source projects and contributing to practical tools."></textarea>
                    </div>
                </div>
            </div>
        `);

        interestIndex++;
    }

    function addEducation() {
        const wrapper = document.getElementById('educations-wrapper');

        wrapper.insertAdjacentHTML('beforeend', `
            <div class="education-item bg-surface-soft border border-line rounded-xl p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-ink">
                            Education Item
                        </p>
                        <p class="text-sm text-muted">
                            Institution, degree, study field, dates, and description.
                        </p>
                    </div>

                    <button type="button"
                            onclick="removeItem(this, '.education-item')"
                            class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                        Remove
                    </button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block mb-2 font-bold text-ink">Institution Name</label>
                        <input type="text"
                               name="educations[${educationIndex}][institution_name]"
                               class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: University Name">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold text-ink">Degree</label>
                            <input type="text"
                                   name="educations[${educationIndex}][degree]"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: M.Sc.">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-ink">Field of Study</label>
                            <input type="text"
                                   name="educations[${educationIndex}][field_of_study]"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Computer Science">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold text-ink">Start Date</label>
                            <input type="month"
                                   name="educations[${educationIndex}][start_date]"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-ink">End Date</label>
                            <input type="month"
                                   name="educations[${educationIndex}][end_date]"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-ink">Description</label>
                        <textarea name="educations[${educationIndex}][description]"
                                  rows="3"
                                  class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Example: Focused on software engineering, data science, and applied computer science."></textarea>
                    </div>
                </div>
            </div>
        `);

        educationIndex++;
    }

    function addExperience() {
        const wrapper = document.getElementById('experiences-wrapper');

        wrapper.insertAdjacentHTML('beforeend', `
            <div class="experience-item bg-surface-soft border border-line rounded-xl p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-ink">
                            Experience Item
                        </p>
                        <p class="text-sm text-muted">
                            Company, job title, dates, and responsibilities.
                        </p>
                    </div>

                    <button type="button"
                            onclick="removeItem(this, '.experience-item')"
                            class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                        Remove
                    </button>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold text-ink">Company Name</label>
                            <input type="text"
                                   name="experiences[${experienceIndex}][company_name]"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Company Name">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-ink">Job Title / Internship Title</label>
                            <input type="text"
                                   name="experiences[${experienceIndex}][job_title]"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Data Analyst">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold text-ink">Start Date</label>
                            <input type="month"
                                   name="experiences[${experienceIndex}][start_date]" max="{{ now()->format('Y-m') }}"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-ink">End Date</label>
                            <input type="month"
                                   name="experiences[${experienceIndex}][end_date]" max="{{ now()->format('Y-m') }}"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-ink">Description</label>
                        <textarea name="experiences[${experienceIndex}][description]"
                                  rows="4"
                                  class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Describe responsibilities, tools, and achievements."></textarea>
                    </div>
                </div>
            </div>
        `);

        experienceIndex++;
    }

    function addProject() {
        const wrapper = document.getElementById('projects-wrapper');

        wrapper.insertAdjacentHTML('beforeend', `
            <div class="project-item bg-surface-soft border border-line rounded-xl p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-ink">
                            Project Item
                        </p>
                        <p class="text-sm text-muted">
                            Project title, description, and link.
                        </p>
                    </div>

                    <button type="button"
                            onclick="removeItem(this, '.project-item')"
                            class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                        Remove
                    </button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block mb-2 font-bold text-ink">Project Title</label>
                        <input type="text"
                               name="projects[${projectIndex}][project_title]"
                               class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Portfolio Website">
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-ink">Project Description</label>
                        <textarea name="projects[${projectIndex}][project_description]"
                                  rows="4"
                                  class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Describe the project, technologies, and main features."></textarea>
                    </div>

                    <div>
                        <label for="project-link-text-${projectIndex}" class="block mb-2 font-bold text-ink">Link text (optional)</label>
                        <input id="project-link-text-${projectIndex}" type="text" name="projects[${projectIndex}][project_link_label]"
                               maxlength="100" placeholder="Example: Watch the project demo"
                               class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-2 font-bold text-ink">Project Link</label>
                        <input type="url"
                               name="projects[${projectIndex}][project_link]"
                               class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                               placeholder="https://github.com/username/project">
                    </div>
                    <div>
                        <label for="project-demo-text-${projectIndex}" class="block mb-2 font-bold text-ink">Demo link text (optional)</label>
                        <input id="project-demo-text-${projectIndex}" type="text" name="projects[${projectIndex}][demo_label]" maxlength="100"
                               placeholder="Example: Watch the video demo" class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="project-demo-url-${projectIndex}" class="block mb-2 font-bold text-ink">Demo URL (optional)</label>
                        <input id="project-demo-url-${projectIndex}" type="url" name="projects[${projectIndex}][demo_url]" maxlength="2048"
                               placeholder="https://www.youtube.com/watch?v=..." class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
            </div>
        `);

        projectIndex++;
    }

    function addCertificate() {
        const wrapper = document.getElementById('certificates-wrapper');

        wrapper.insertAdjacentHTML('beforeend', `
            <div class="certificate-item bg-surface-soft border border-line rounded-xl p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-ink">
                            Certificate Item
                        </p>
                        <p class="text-sm text-muted">
                            Certificate title, issuer, dates, credential, and file.
                        </p>
                    </div>

                    <button type="button"
                            onclick="removeItem(this, '.certificate-item')"
                            class="inline-flex justify-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold text-sm">
                        Remove
                    </button>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold text-ink">Certificate Title</label>
                            <input type="text"
                                   name="certificates[${certificateIndex}][certificate_title]"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Professional Certificate">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-ink">Issuer</label>
                            <input type="text"
                                   name="certificates[${certificateIndex}][issuer]"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Certificate Provider">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold text-ink">Issue Date</label>
                            <input type="date"
                                   name="certificates[${certificateIndex}][issue_date]"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-ink">Credential ID</label>
                            <input type="text"
                                   name="certificates[${certificateIndex}][credential_id]"
                                   class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: ABC-123">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-ink">Credential URL</label>
                        <input type="url"
                               name="certificates[${certificateIndex}][credential_url]"
                               class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                               placeholder="https://example.com/certificate">
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-ink">Certificate File</label>
                        <input type="file"
                               name="certificates[${certificateIndex}][certificate_file]"
                               accept=".pdf,.jpg,.jpeg,.png,.webp"
                               class="w-full border border-line rounded-md px-4 py-2.5 bg-surface shadow-xs focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-ink">Description</label>
                        <textarea name="certificates[${certificateIndex}][description]"
                                  rows="3"
                                  class="w-full border border-line rounded-md px-4 py-2.5 shadow-xs focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Short description of what the certificate covers."></textarea>
                    </div>
                    <div>
                        <label class="block mb-2 font-bold text-ink">Related Project Title</label>
                        <input type="text" name="certificates[${certificateIndex}][related_project_title]" class="w-full border border-line rounded-md px-4 py-2.5">
                    </div>
                    <div>
                        <label class="block mb-2 font-bold text-ink">Related Project Link</label>
                        <input type="url" name="certificates[${certificateIndex}][related_project_link]" class="w-full border border-line rounded-md px-4 py-2.5">
                    </div>
                </div>
            </div>
        `);

        certificateIndex++;
    }
</script>