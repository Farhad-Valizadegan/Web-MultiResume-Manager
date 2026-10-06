# Implementation Guide

Status: Documented baseline
Reviewed: 2026-10-06
Evidence baseline: local commit 0ca188f (merged project rename), with release history through v1.2.1.

| Entry point | Responsibility |
| --- | --- |
| routes/web.php and routes/auth.php | Route groups, authentication/public boundaries |
| app/Http/Middleware | Role and active-account enforcement |
| app/Http/Controllers/User/ResumeController.php | Editing, validation and nested-section persistence |
| app/Http/Controllers/PublicResumeController.php | Public access, views and PDF downloads |
| app/Http/Controllers/ResumeFileController.php | Authorized file responses |
| app/Services/ResumeFiles.php | Upload/replacement cleanup around transactions |
| app/Models and database/migrations | Relationships and schema evolution |
| resources/views/user/resumes | Create/edit templates and repeatable fields |
| resources/views/public | Public presentation and generated PDF |
| resources/js/appearance.js and workspace.js | Appearance, navigation, labels and editor interactions |

Use config('app.name') for visible product branding. Maintain both initial and dynamically added editor fields. Validate nested attributes server-side and escape rendered values. Persist schema changes with migrations; avoid destructive database recreation for normal upgrades. Keep root package metadata and lockfiles consistent without unrelated dependency churn.

Use the [testing guide](../06-testing/testing.md) for validation. Do not place secrets, actual resumes or production configuration in examples or commits.
