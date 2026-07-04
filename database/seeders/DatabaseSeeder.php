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
        /*
        |--------------------------------------------------------------------------
        | Demo Users
        |--------------------------------------------------------------------------
        */

        $user = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('password'),
                'role' => 'user',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Demo User Profile
        |--------------------------------------------------------------------------
        */

        DB::table('profiles')->updateOrInsert(
            ['user_id' => $user->id],
            [
                'phone' => '+49 176 12345678',
                'address' => 'Erlangen, Germany',
                'website' => 'https://demo-resume.example.com',
                'linkedin' => 'https://www.linkedin.com/in/demo-user',
                'github' => 'https://github.com/demo-user',
                'portfolio' => 'https://portfolio.example.com',
                'xing' => 'https://www.xing.com/profile/demo_user',
                'bio' => 'Motivated software developer with experience in full-stack web development, database design, data analysis, and building practical digital systems. Interested in clean code, scalable applications, and user-focused software solutions.',
                'profile_photo' => 'profile-photos/demo-profile.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Clean Previous Demo Resumes
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
        | Resume 1: Software Developer Resume
        |--------------------------------------------------------------------------
        */

        $softwareResumeId = DB::table('resumes')->insertGetId([
            'user_id' => $user->id,
            'title' => 'Software Developer Resume',
            'job_position' => 'Full-Stack Web Developer',
            'public_link' => $this->generateUniquePublicLink(),
            'resume_password_hash' => Hash::make('123456'),
            'uploaded_resume_file' => null,
            'download_resume_type' => 'generated',
            'skill_display_style' => 'compact',
            'view_count' => 0,
            'last_viewed_at' => null,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('resume_skills')->insert([
            [
                'resume_id' => $softwareResumeId,
                'skill_category' => 'Programming Languages',
                'skill_name' => 'PHP',
                'skill_level' => 'Advanced',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $softwareResumeId,
                'skill_category' => 'Programming Languages',
                'skill_name' => 'JavaScript',
                'skill_level' => 'Advanced',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $softwareResumeId,
                'skill_category' => 'Programming Languages',
                'skill_name' => 'Python',
                'skill_level' => 'Intermediate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $softwareResumeId,
                'skill_category' => 'Frameworks',
                'skill_name' => 'Laravel',
                'skill_level' => 'Advanced',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $softwareResumeId,
                'skill_category' => 'Frameworks',
                'skill_name' => 'React',
                'skill_level' => 'Intermediate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $softwareResumeId,
                'skill_category' => 'Databases',
                'skill_name' => 'MySQL',
                'skill_level' => 'Advanced',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $softwareResumeId,
                'skill_category' => 'Tools',
                'skill_name' => 'Git',
                'skill_level' => 'Advanced',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $softwareResumeId,
                'skill_category' => 'Tools',
                'skill_name' => 'Docker',
                'skill_level' => 'Basic',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('resume_experiences')->insert([
            [
                'resume_id' => $softwareResumeId,
                'company_name' => 'Zar Vision Rasta Co.',
                'job_title' => 'Data Analyst & Web Developer',
                'start_date' => '2020-01-01',
                'end_date' => '2023-08-31',
                'description' => 'Developed web-based internal tools, designed database structures, cleaned and analyzed business data, and created dashboards to support management decisions.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $softwareResumeId,
                'company_name' => 'Independent Project',
                'job_title' => 'Laravel Resume Management System Developer',
                'start_date' => '2026-01-01',
                'end_date' => null,
                'description' => 'Designed and implemented a Laravel-based resume management platform with authentication, user/admin roles, protected public resume links, PDF export, and resume view tracking.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('resume_educations')->insert([
            [
                'resume_id' => $softwareResumeId,
                'institution_name' => 'FAU Erlangen-Nürnberg',
                'degree' => 'M.Sc.',
                'field_of_study' => 'Computational Engineering',
                'start_date' => '2023-10-01',
                'end_date' => null,
                'description' => 'Master studies focused on computational methods, programming, optimization, machine learning, and engineering applications.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $softwareResumeId,
                'institution_name' => 'Islamic Azad University',
                'degree' => 'B.Sc.',
                'field_of_study' => 'Computer Software Engineering',
                'start_date' => '2010-09-01',
                'end_date' => '2014-09-01',
                'description' => 'Bachelor studies in software engineering, programming, databases, web development, and software design.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('resume_projects')->insert([
            [
                'resume_id' => $softwareResumeId,
                'project_title' => 'Resume Management System',
                'project_description' => 'A Laravel application that allows users to create, manage, protect, and share professional resumes through public links.',
                'project_link' => 'https://github.com/demo-user/resume-management-system',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $softwareResumeId,
                'project_title' => 'Online Academic Document Editor',
                'project_description' => 'Concept for a web-based academic editor with autosave, PDF export, version history, and AI writing assistance.',
                'project_link' => 'https://github.com/demo-user/academic-document-editor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('resume_certificates')->insert([
            [
                'resume_id' => $softwareResumeId,
                'certificate_title' => 'Laravel Web Development Certificate',
                'issuer' => 'Demo Academy',
                'issue_date' => '2025-06-15',
                'credential_id' => 'LARAVEL-DEMO-001',
                'credential_url' => 'https://certificate.example.com/laravel-demo-001',
                'certificate_file' => 'certificate-files/demo-certificate-one.png',
                'description' => 'Certificate for completing a practical Laravel web development course.',
                'related_project_title' => 'Resume Management System',
                'related_project_link' => 'https://github.com/demo-user/resume-management-system',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $softwareResumeId,
                'certificate_title' => 'JavaScript Frontend Development',
                'issuer' => 'Demo Institute',
                'issue_date' => '2025-09-10',
                'credential_id' => 'JS-DEMO-002',
                'credential_url' => 'https://certificate.example.com/js-demo-002',
                'certificate_file' => 'certificate-files/demo-certificate-two.png',
                'description' => 'Certificate for frontend development with JavaScript, DOM manipulation, and modern UI techniques.',
                'related_project_title' => 'Online Academic Document Editor',
                'related_project_link' => 'https://github.com/demo-user/academic-document-editor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('resume_languages')->insert([
            [
                'resume_id' => $softwareResumeId,
                'language_name' => 'English',
                'proficiency_level' => 'B2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $softwareResumeId,
                'language_name' => 'German',
                'proficiency_level' => 'A1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $softwareResumeId,
                'language_name' => 'Persian',
                'proficiency_level' => 'Native',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('resume_interests')->insert([
            [
                'resume_id' => $softwareResumeId,
                'interest_name' => 'Clean Code',
                'description' => 'Interest in readable, maintainable, and well-structured software design.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $softwareResumeId,
                'interest_name' => 'UI/UX Design',
                'description' => 'Interest in creating clear, accessible, and user-friendly web interfaces.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Resume 2: Data Analyst Resume
        |--------------------------------------------------------------------------
        */

        $dataResumeId = DB::table('resumes')->insertGetId([
            'user_id' => $user->id,
            'title' => 'Data Analyst Resume',
            'job_position' => 'Data Analyst / Junior Data Scientist',
            'public_link' => $this->generateUniquePublicLink(),
            'resume_password_hash' => Hash::make('123456'),
            'uploaded_resume_file' => null,
            'download_resume_type' => 'generated',
            'skill_display_style' => 'cards',
            'view_count' => 0,
            'last_viewed_at' => null,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('resume_skills')->insert([
            [
                'resume_id' => $dataResumeId,
                'skill_category' => 'Data Analysis',
                'skill_name' => 'Data Cleaning',
                'skill_level' => 'Advanced',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $dataResumeId,
                'skill_category' => 'Data Analysis',
                'skill_name' => 'Exploratory Data Analysis',
                'skill_level' => 'Advanced',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $dataResumeId,
                'skill_category' => 'Programming',
                'skill_name' => 'Python',
                'skill_level' => 'Advanced',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $dataResumeId,
                'skill_category' => 'Programming',
                'skill_name' => 'SQL',
                'skill_level' => 'Advanced',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $dataResumeId,
                'skill_category' => 'Libraries',
                'skill_name' => 'Pandas',
                'skill_level' => 'Advanced',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $dataResumeId,
                'skill_category' => 'Libraries',
                'skill_name' => 'NumPy',
                'skill_level' => 'Intermediate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $dataResumeId,
                'skill_category' => 'Machine Learning',
                'skill_name' => 'scikit-learn',
                'skill_level' => 'Intermediate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $dataResumeId,
                'skill_category' => 'Visualization',
                'skill_name' => 'Dashboards',
                'skill_level' => 'Advanced',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('resume_experiences')->insert([
            [
                'resume_id' => $dataResumeId,
                'company_name' => 'Zar Vision Rasta Co.',
                'job_title' => 'Data Analyst & Web Developer',
                'start_date' => '2020-01-01',
                'end_date' => '2023-08-31',
                'description' => 'Cleaned and structured business data, analyzed trends, created reports, designed dashboards, and supported decision-making with database-driven insights.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('resume_educations')->insert([
            [
                'resume_id' => $dataResumeId,
                'institution_name' => 'FAU Erlangen-Nürnberg',
                'degree' => 'M.Sc.',
                'field_of_study' => 'Computational Engineering',
                'start_date' => '2023-10-01',
                'end_date' => null,
                'description' => 'Studies related to numerical methods, optimization, programming, data science, and machine learning applications.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $dataResumeId,
                'institution_name' => 'Islamic Azad University',
                'degree' => 'B.Sc.',
                'field_of_study' => 'Computer Software Engineering',
                'start_date' => '2010-09-01',
                'end_date' => '2014-09-01',
                'description' => 'Academic background in software engineering, databases, programming, and information systems.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('resume_projects')->insert([
            [
                'resume_id' => $dataResumeId,
                'project_title' => 'AI-Powered Resume and Job Matching Dashboard',
                'project_description' => 'A planned dashboard for comparing resumes with job descriptions using text analysis, scoring, and skill gap detection.',
                'project_link' => 'https://github.com/demo-user/ai-resume-job-matching',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $dataResumeId,
                'project_title' => 'Business Data Dashboard',
                'project_description' => 'Dashboard concept for monitoring sales, customer behavior, and operational trends using cleaned and structured datasets.',
                'project_link' => 'https://github.com/demo-user/business-data-dashboard',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('resume_certificates')->insert([
            [
                'resume_id' => $dataResumeId,
                'certificate_title' => 'Data Analysis with Python',
                'issuer' => 'Demo Data Academy',
                'issue_date' => '2025-11-20',
                'credential_id' => 'DATA-DEMO-003',
                'credential_url' => 'https://certificate.example.com/data-demo-003',
                'certificate_file' => 'certificate-files/demo-certificate-three.png',
                'description' => 'Certificate for data analysis using Python, Pandas, NumPy, and visualization workflows.',
                'related_project_title' => 'Business Data Dashboard',
                'related_project_link' => 'https://github.com/demo-user/business-data-dashboard',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('resume_languages')->insert([
            [
                'resume_id' => $dataResumeId,
                'language_name' => 'English',
                'proficiency_level' => 'B2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $dataResumeId,
                'language_name' => 'German',
                'proficiency_level' => 'A1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $dataResumeId,
                'language_name' => 'Persian',
                'proficiency_level' => 'Native',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('resume_interests')->insert([
            [
                'resume_id' => $dataResumeId,
                'interest_name' => 'Machine Learning',
                'description' => 'Interest in practical machine learning applications and data-driven decision systems.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id' => $dataResumeId,
                'interest_name' => 'Data Visualization',
                'description' => 'Interest in transforming raw data into understandable dashboards and insights.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    private function generateUniquePublicLink(): string
    {
        do {
            $publicLink = 'r-' . Str::lower(Str::random(8));
        } while (DB::table('resumes')->where('public_link', $publicLink)->exists());

        return $publicLink;
    }
}