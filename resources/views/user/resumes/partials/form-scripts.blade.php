<script>
    let skillIndex = {{ isset($resume) ? max($resume->skills->count(), 1) : 1 }};
    let languageIndex = {{ isset($resume) ? max($resume->languages->count(), 1) : 1 }};
    let interestIndex = {{ isset($resume) ? max($resume->interests->count(), 1) : 1 }};
    let educationIndex = {{ isset($resume) ? max($resume->educations->count(), 1) : 1 }};
    let experienceIndex = {{ isset($resume) ? max($resume->experiences->count(), 1) : 1 }};
    let projectIndex = {{ isset($resume) ? max($resume->projects->count(), 1) : 1 }};
    let certificateIndex = {{ isset($resume) ? max($resume->certificates->count(), 1) : 1 }};

    function removeItem(button, selector) {
        button.closest(selector).remove();
    }

    function addSkill() {
        const wrapper = document.getElementById('skills-wrapper');

        wrapper.insertAdjacentHTML('beforeend', `
            <div class="skill-item bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-slate-900">
                            Skill Item
                        </p>
                        <p class="text-sm text-slate-500">
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
                        <label class="block mb-2 font-bold text-slate-800">Skill Category</label>
                        <input type="text"
                               name="skills[${skillIndex}][skill_category]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Web Development">
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-slate-800">Skill Name</label>
                        <input type="text"
                               name="skills[${skillIndex}][skill_name]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Laravel">
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-slate-800">Skill Level</label>
                        <input type="text"
                               name="skills[${skillIndex}][skill_level]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Intermediate">
                    </div>
                </div>
            </div>
        `);

        skillIndex++;
    }

    function addLanguage() {
        const wrapper = document.getElementById('languages-wrapper');

        wrapper.insertAdjacentHTML('beforeend', `
            <div class="language-item bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-slate-900">
                            Language Item
                        </p>
                        <p class="text-sm text-slate-500">
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
                        <label class="block mb-2 font-bold text-slate-800">Language</label>
                        <input type="text"
                               name="languages[${languageIndex}][language_name]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Language Name">
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-slate-800">Proficiency Level</label>
                        <input type="text"
                               name="languages[${languageIndex}][proficiency_level]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
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
            <div class="interest-item bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-slate-900">
                            Interest Item
                        </p>
                        <p class="text-sm text-slate-500">
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
                        <label class="block mb-2 font-bold text-slate-800">Interest / Hobby Name</label>
                        <input type="text"
                               name="interests[${interestIndex}][interest_name]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Open Source">
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-slate-800">Description</label>
                        <textarea name="interests[${interestIndex}][description]"
                                  rows="3"
                                  class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
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
            <div class="education-item bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-slate-900">
                            Education Item
                        </p>
                        <p class="text-sm text-slate-500">
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
                        <label class="block mb-2 font-bold text-slate-800">Institution Name</label>
                        <input type="text"
                               name="educations[${educationIndex}][institution_name]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: University Name">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">Degree</label>
                            <input type="text"
                                   name="educations[${educationIndex}][degree]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: M.Sc.">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-slate-800">Field of Study</label>
                            <input type="text"
                                   name="educations[${educationIndex}][field_of_study]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Computer Science">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">Start Date</label>
                            <input type="date"
                                   name="educations[${educationIndex}][start_date]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-slate-800">End Date</label>
                            <input type="date"
                                   name="educations[${educationIndex}][end_date]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-slate-800">Description</label>
                        <textarea name="educations[${educationIndex}][description]"
                                  rows="3"
                                  class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
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
            <div class="experience-item bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-slate-900">
                            Experience Item
                        </p>
                        <p class="text-sm text-slate-500">
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
                            <label class="block mb-2 font-bold text-slate-800">Company Name</label>
                            <input type="text"
                                   name="experiences[${experienceIndex}][company_name]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Company Name">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-slate-800">Job Title / Internship Title</label>
                            <input type="text"
                                   name="experiences[${experienceIndex}][job_title]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Data Analyst">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">Start Date</label>
                            <input type="date"
                                   name="experiences[${experienceIndex}][start_date]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-slate-800">End Date</label>
                            <input type="date"
                                   name="experiences[${experienceIndex}][end_date]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-slate-800">Description</label>
                        <textarea name="experiences[${experienceIndex}][description]"
                                  rows="4"
                                  class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
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
            <div class="project-item bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-slate-900">
                            Project Item
                        </p>
                        <p class="text-sm text-slate-500">
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
                        <label class="block mb-2 font-bold text-slate-800">Project Title</label>
                        <input type="text"
                               name="projects[${projectIndex}][project_title]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Example: Portfolio Website">
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-slate-800">Project Description</label>
                        <textarea name="projects[${projectIndex}][project_description]"
                                  rows="4"
                                  class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Describe the project, technologies, and main features."></textarea>
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-slate-800">Project Link</label>
                        <input type="url"
                               name="projects[${projectIndex}][project_link]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="https://github.com/username/project">
                    </div>
                </div>
            </div>
        `);

        projectIndex++;
    }

    function addCertificate() {
        const wrapper = document.getElementById('certificates-wrapper');

        wrapper.insertAdjacentHTML('beforeend', `
            <div class="certificate-item bg-slate-50 border-2 border-slate-200 rounded-lg p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <p class="font-bold text-slate-900">
                            Certificate Item
                        </p>
                        <p class="text-sm text-slate-500">
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
                            <label class="block mb-2 font-bold text-slate-800">Certificate Title</label>
                            <input type="text"
                                   name="certificates[${certificateIndex}][certificate_title]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Professional Certificate">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-slate-800">Issuer</label>
                            <input type="text"
                                   name="certificates[${certificateIndex}][issuer]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: Certificate Provider">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold text-slate-800">Issue Date</label>
                            <input type="date"
                                   name="certificates[${certificateIndex}][issue_date]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-slate-800">Credential ID</label>
                            <input type="text"
                                   name="certificates[${certificateIndex}][credential_id]"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Example: ABC-123">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-slate-800">Credential URL</label>
                        <input type="url"
                               name="certificates[${certificateIndex}][credential_url]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="https://example.com/certificate">
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-slate-800">Certificate File</label>
                        <input type="file"
                               name="certificates[${certificateIndex}][certificate_file]"
                               class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-slate-800">Description</label>
                        <textarea name="certificates[${certificateIndex}][description]"
                                  rows="3"
                                  class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Short description of what the certificate covers."></textarea>
                    </div>
                </div>
            </div>
        `);

        certificateIndex++;
    }
</script>