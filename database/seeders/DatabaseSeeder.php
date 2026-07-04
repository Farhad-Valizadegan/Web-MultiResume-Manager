<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        /*
        |--------------------------------------------------------------------------
        | Demo users
        |--------------------------------------------------------------------------
        */

        $user = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Farhad Valizadegan',
                'password' => Hash::make('password'),
                'role' => 'user',
                'status' => 'active',
                'email_verified_at' => $now,
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => $now,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        DB::table('profiles')->updateOrInsert(
            ['user_id' => $user->id],
            [
                'phone' => '+49 000 00000000',
                'address' => 'Erlangen, Bavaria, Germany',
                'bio' => 'Software engineering and data-focused developer with experience in Laravel, PHP, JavaScript, Python, SQL, dashboard development, and practical web application design.',
                'website' => 'https://resumefolio.de',
                'profile_photo' => 'profile-photos/demo-profile.jpg',
                'linkedin' => 'https://www.linkedin.com/in/farhad-valizadegan',
                'github' => 'https://github.com/Farhad-Valizadegan',
                'portfolio' => 'https://resumefolio.de',
                'xing' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Remove previous demo resumes
        |--------------------------------------------------------------------------
        */

        DB::table('resumes')
            ->where('user_id', $user->id)
            ->whereIn('title', [
                'Software Developer Resume',
                'Data Analyst Resume',
            ])
            ->delete();

        /*
        |--------------------------------------------------------------------------
        | Resume 1: Software Developer
        |--------------------------------------------------------------------------
        */

        $softwareResumeId = DB::table('resumes')->insertGetId([
            'user_id' => $user->id,
            'title' => 'Software Developer Resume',
            'job_position' => 'Software Developer',
            'public_link' => Str::uuid()->toString(),
            'resume_password_hash' => Hash::make('123456'),
            'uploaded_resume_file' => null,
            'download_resume_type' => 'generated',
            'status' => 'active',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->seedSoftwareDeveloperResume($softwareResumeId, $now);

        /*
        |--------------------------------------------------------------------------
        | Resume 2: Data Analyst
        |--------------------------------------------------------------------------
        */

        $dataResumeId = DB::table('resumes')->insertGetId([
            'user_id' => $user->id,
            'title' => 'Data Analyst Resume',
            'job_position' => 'Data Analyst',
            'public_link' => Str::uuid()->toString(),
            'resume_password_hash' => Hash::make('123456'),
            'uploaded_resume_file' => null,
            'download_resume_type' => 'generated',
            'status' => 'active',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->seedDataAnalystResume($dataResumeId, $now);
    }

    private function seedSoftwareDeveloperResume(int $resumeId, $now): void
    {
        DB::table('resume_skills')->insert([
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Programming Languages',
                'skill_name' => 'PHP',
                'skill_level' => 'Advanced',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Programming Languages',
                'skill_name' => 'JavaScript',
                'skill_level' => 'Advanced',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Programming Languages',
                'skill_name' => 'Python',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Programming Languages',
                'skill_name' => 'SQL',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Frameworks & Libraries',
                'skill_name' => 'Laravel',
                'skill_level' => 'Advanced',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Frameworks & Libraries',
                'skill_name' => 'Blade',
                'skill_level' => 'Advanced',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Frameworks & Libraries',
                'skill_name' => 'Tailwind CSS',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Frameworks & Libraries',
                'skill_name' => 'Alpine.js',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Databases',
                'skill_name' => 'MySQL',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Databases',
                'skill_name' => 'Database Design',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Tools',
                'skill_name' => 'Git',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Tools',
                'skill_name' => 'GitHub',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Tools',
                'skill_name' => 'Composer',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Tools',
                'skill_name' => 'NPM',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('resume_experiences')->insert([
            [
                'resume_id' => $resumeId,
                'company_name' => 'Zar Vision Rasta Co.',
                'job_title' => 'Data Analyst & Web Developer',
                'start_date' => '2020-01-01',
                'end_date' => '2023-09-01',
                'description' => 'Developed internal web applications and supported data analysis tasks, including data cleaning, reporting, dashboard creation, database management, and trend analysis. Worked with PHP, JavaScript, Python, SQL, HTML, CSS, and spreadsheet tools to improve business workflows.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'company_name' => 'Bugloos',
                'job_title' => 'Backend Developer Trainee',
                'start_date' => '2019-01-01',
                'end_date' => '2019-12-01',
                'description' => 'Focused on server-side programming, database operations, authentication, API structure, and application logic. Gained practical experience in backend development workflows and maintainable code organization.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('resume_educations')->insert([
            [
                'resume_id' => $resumeId,
                'institution_name' => 'FAU Erlangen-Nürnberg',
                'degree' => 'M.Sc.',
                'field_of_study' => 'Computational Engineering',
                'start_date' => '2023-10-01',
                'end_date' => null,
                'description' => 'Master’s studies with focus on software engineering, optimization, data analysis, machine learning, numerical methods, and computational problem solving.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'institution_name' => 'Islamic Azad University, Shahr-e Rey',
                'degree' => 'B.Sc.',
                'field_of_study' => 'Computer Software Engineering',
                'start_date' => '2012-09-01',
                'end_date' => '2016-09-01',
                'description' => 'Bachelor’s studies with focus on programming, databases, algorithms, web development, software design, and computer systems.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('resume_projects')->insert([
            [
                'resume_id' => $resumeId,
                'project_title' => 'Laravel Resume Management System',
                'project_description' => 'Developed a full-stack Laravel resume management system with admin and user dashboards, secure authentication, role-based access control, MySQL integration, public resume links, view counters, CAPTCHA login protection, and responsive Blade/Tailwind CSS interfaces.',
                'project_link' => 'https://github.com/Farhad-Valizadegan/web-resume-management-system',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'project_title' => 'Public Resume Portfolio',
                'project_description' => 'Designed a public resume presentation page with protected access, downloadable PDF options, profile information, categorized sections, and responsive layout.',
                'project_link' => 'https://resumefolio.de',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('resume_certificates')->insert([
            [
                'resume_id' => $resumeId,
                'certificate_title' => 'Python for Data Science, AI & Development',
                'issuer' => 'IBM / Coursera',
                'issue_date' => '2024-01-01',
                'credential_id' => 'IBM-PY-DS-001',
                'credential_url' => null,
                'certificate_file' => 'certificate-files/demo-certificate-one.png',
                'description' => 'Certificate focused on Python programming for data science, artificial intelligence, and development.',
                'related_project_title' => 'Machine Learning Prediction Project',
                'related_project_link' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'certificate_title' => 'Laravel Web Development',
                'issuer' => 'Demo Academy',
                'issue_date' => '2025-01-01',
                'credential_id' => 'LARAVEL-DEMO-002',
                'credential_url' => null,
                'certificate_file' => 'certificate-files/demo-certificate-two.png',
                'description' => 'Certificate focused on Laravel application structure, Blade templates, routing, controllers, authentication, and database-driven development.',
                'related_project_title' => 'Laravel Resume Management System',
                'related_project_link' => 'https://github.com/Farhad-Valizadegan/web-resume-management-system',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('resume_languages')->insert([
            [
                'resume_id' => $resumeId,
                'language_name' => 'English',
                'proficiency_level' => 'B2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'language_name' => 'German',
                'proficiency_level' => 'A1/A2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'language_name' => 'Persian',
                'proficiency_level' => 'Native',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('resume_interests')->insert([
            [
                'resume_id' => $resumeId,
                'interest_name' => 'Technical Reading and Research',
                'description' => 'Interested in technical articles, software engineering materials, web development, data analysis, and artificial intelligence topics.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'interest_name' => 'Open Source',
                'description' => 'Interested in open-source software because it supports learning, collaboration, transparency, and continuous improvement.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    private function seedDataAnalystResume(int $resumeId, $now): void
    {
        DB::table('resume_skills')->insert([
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Data Analysis',
                'skill_name' => 'Data Cleaning',
                'skill_level' => 'Advanced',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Data Analysis',
                'skill_name' => 'Data Visualization',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Data Analysis',
                'skill_name' => 'Dashboard Creation',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Python Libraries',
                'skill_name' => 'Pandas',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Python Libraries',
                'skill_name' => 'NumPy',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Python Libraries',
                'skill_name' => 'scikit-learn',
                'skill_level' => 'Basic',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Databases',
                'skill_name' => 'SQL',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Databases',
                'skill_name' => 'MySQL',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Tools',
                'skill_name' => 'Excel',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'skill_category' => 'Tools',
                'skill_name' => 'Jupyter Notebook',
                'skill_level' => 'Intermediate',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('resume_experiences')->insert([
            [
                'resume_id' => $resumeId,
                'company_name' => 'Zar Vision Rasta Co.',
                'job_title' => 'Data Analyst & Web Developer',
                'start_date' => '2020-01-01',
                'end_date' => '2023-09-01',
                'description' => 'Performed data cleaning, structuring, trend analysis, dashboard creation, and reporting. Supported business decision-making by improving access to structured data and analytical summaries.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('resume_educations')->insert([
            [
                'resume_id' => $resumeId,
                'institution_name' => 'FAU Erlangen-Nürnberg',
                'degree' => 'M.Sc.',
                'field_of_study' => 'Computational Engineering',
                'start_date' => '2023-10-01',
                'end_date' => null,
                'description' => 'Master’s studies with focus on computational methods, optimization, data analysis, and applied problem solving.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'institution_name' => 'Islamic Azad University, Shahr-e Rey',
                'degree' => 'B.Sc.',
                'field_of_study' => 'Computer Software Engineering',
                'start_date' => '2012-09-01',
                'end_date' => '2016-09-01',
                'description' => 'Bachelor’s studies with focus on programming, databases, algorithms, software design, and computer systems.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('resume_projects')->insert([
            [
                'resume_id' => $resumeId,
                'project_title' => 'Machine Learning Prediction Project',
                'project_description' => 'Developed a machine learning project using Python, Pandas, NumPy, and scikit-learn. Worked on preprocessing, exploratory data analysis, feature preparation, model training, prediction, and evaluation.',
                'project_link' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'project_title' => 'Business Data Dashboard',
                'project_description' => 'Created dashboards and reports for business data using structured datasets, SQL queries, and analytical summaries.',
                'project_link' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('resume_certificates')->insert([
            [
                'resume_id' => $resumeId,
                'certificate_title' => 'Python for Data Science, AI & Development',
                'issuer' => 'IBM / Coursera',
                'issue_date' => '2024-01-01',
                'credential_id' => 'IBM-PY-DS-001',
                'credential_url' => null,
                'certificate_file' => 'certificate-files/demo-certificate-three.png',
                'description' => 'Certificate focused on Python programming for data science, artificial intelligence, and development.',
                'related_project_title' => 'Machine Learning Prediction Project',
                'related_project_link' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('resume_languages')->insert([
            [
                'resume_id' => $resumeId,
                'language_name' => 'English',
                'proficiency_level' => 'B2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'language_name' => 'German',
                'proficiency_level' => 'A1/A2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'language_name' => 'Persian',
                'proficiency_level' => 'Native',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('resume_interests')->insert([
            [
                'resume_id' => $resumeId,
                'interest_name' => 'Data-Driven Problem Solving',
                'description' => 'Interested in using data to understand problems, identify patterns, and support better decisions.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'resume_id' => $resumeId,
                'interest_name' => 'Continuous Learning',
                'description' => 'Interested in learning new tools and improving technical skills in software development, data analysis, and artificial intelligence.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}