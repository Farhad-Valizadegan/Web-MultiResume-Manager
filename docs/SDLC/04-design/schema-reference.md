# Migration and Schema Reference

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

Migration operations below are source evidence, not a database introspection dump. Read migrations in order; later alterations and removals supersede earlier operations. Down methods are excluded from these excerpts. Do not treat inferred parser output as a fully normalized final schema.

## 0001_01_01_000000_create_users_table.php

[Source](../../../application/database/migrations/0001_01_01_000000_create_users_table.php)

```php
Schema::create('users', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->string('email')->unique();
$table->timestamp('email_verified_at')->nullable();
$table->string('password');
$table->rememberToken();
$table->timestamps();
Schema::create('password_reset_tokens', function (Blueprint $table) {
$table->string('email')->primary();
$table->string('token');
$table->timestamp('created_at')->nullable();
Schema::create('sessions', function (Blueprint $table) {
$table->string('id')->primary();
$table->foreignId('user_id')->nullable()->index();
$table->string('ip_address', 45)->nullable();
$table->text('user_agent')->nullable();
$table->longText('payload');
$table->integer('last_activity')->index();
```

## 0001_01_01_000001_create_cache_table.php

[Source](../../../application/database/migrations/0001_01_01_000001_create_cache_table.php)

```php
Schema::create('cache', function (Blueprint $table) {
$table->string('key')->primary();
$table->mediumText('value');
$table->integer('expiration');
Schema::create('cache_locks', function (Blueprint $table) {
$table->string('key')->primary();
$table->string('owner');
$table->integer('expiration');
```

## 0001_01_01_000002_create_jobs_table.php

[Source](../../../application/database/migrations/0001_01_01_000002_create_jobs_table.php)

```php
Schema::create('jobs', function (Blueprint $table) {
$table->id();
$table->string('queue')->index();
$table->longText('payload');
$table->unsignedTinyInteger('attempts');
$table->unsignedInteger('reserved_at')->nullable();
$table->unsignedInteger('available_at');
$table->unsignedInteger('created_at');
Schema::create('job_batches', function (Blueprint $table) {
$table->string('id')->primary();
$table->string('name');
$table->integer('total_jobs');
$table->integer('pending_jobs');
$table->integer('failed_jobs');
$table->longText('failed_job_ids');
$table->mediumText('options')->nullable();
$table->integer('cancelled_at')->nullable();
$table->integer('created_at');
$table->integer('finished_at')->nullable();
Schema::create('failed_jobs', function (Blueprint $table) {
$table->id();
$table->string('uuid')->unique();
$table->text('connection');
$table->text('queue');
$table->longText('payload');
$table->longText('exception');
$table->timestamp('failed_at')->useCurrent();
```

## 2026_06_04_184920_add_role_and_status_to_users_table.php

[Source](../../../application/database/migrations/2026_06_04_184920_add_role_and_status_to_users_table.php)

```php
Schema::table('users', function (Blueprint $table) {
$table->string('role')->default('user')->after('password');
$table->string('status')->default('active')->after('role');
```

## 2026_06_04_203810_create_profiles_table.php

[Source](../../../application/database/migrations/2026_06_04_203810_create_profiles_table.php)

```php
Schema::create('profiles', function (Blueprint $table) {
$table->id();
$table->foreignId('user_id')->constrained()->cascadeOnDelete();
$table->string('phone')->nullable();
$table->string('address')->nullable();
$table->text('bio')->nullable();
$table->string('website')->nullable();
$table->timestamps();
```

## 2026_06_04_203811_create_resumes_table.php

[Source](../../../application/database/migrations/2026_06_04_203811_create_resumes_table.php)

```php
Schema::create('resumes', function (Blueprint $table) {
$table->id();
$table->foreignId('user_id')->constrained()->cascadeOnDelete();
$table->string('title');
$table->string('job_position')->nullable();
$table->string('public_link')->unique();
$table->string('resume_password_hash')->nullable();
$table->string('status')->default('active');
$table->timestamps();
```

## 2026_06_04_203812_create_resume_skills_table.php

[Source](../../../application/database/migrations/2026_06_04_203812_create_resume_skills_table.php)

```php
Schema::create('resume_skills', function (Blueprint $table) {
$table->id();
$table->foreignId('resume_id')->constrained()->cascadeOnDelete();
$table->string('skill_name');
$table->string('skill_level')->nullable();
$table->timestamps();
```

## 2026_06_04_203813_create_resume_experiences_table.php

[Source](../../../application/database/migrations/2026_06_04_203813_create_resume_experiences_table.php)

```php
Schema::create('resume_experiences', function (Blueprint $table) {
$table->id();
$table->foreignId('resume_id')->constrained()->cascadeOnDelete();
$table->string('company_name');
$table->string('job_title');
$table->date('start_date')->nullable();
$table->date('end_date')->nullable();
$table->text('description')->nullable();
$table->timestamps();
```

## 2026_06_04_203814_create_resume_educations_table.php

[Source](../../../application/database/migrations/2026_06_04_203814_create_resume_educations_table.php)

```php
Schema::create('resume_educations', function (Blueprint $table) {
$table->id();
$table->foreignId('resume_id')->constrained()->cascadeOnDelete();
$table->string('institution_name');
$table->string('degree')->nullable();
$table->string('field_of_study')->nullable();
$table->date('start_date')->nullable();
$table->date('end_date')->nullable();
$table->timestamps();
```

## 2026_06_04_203815_create_resume_projects_table.php

[Source](../../../application/database/migrations/2026_06_04_203815_create_resume_projects_table.php)

```php
Schema::create('resume_projects', function (Blueprint $table) {
$table->id();
$table->foreignId('resume_id')->constrained()->cascadeOnDelete();
$table->string('project_title');
$table->text('project_description')->nullable();
$table->string('project_link')->nullable();
$table->timestamps();
```

## 2026_06_04_222046_add_resume_password_to_resumes_table.php

[Source](../../../application/database/migrations/2026_06_04_222046_add_resume_password_to_resumes_table.php)

```php
Schema::table('resumes', function (Blueprint $table) {
$table->string('resume_password')->nullable()->after('public_link');
```

## 2026_06_05_111947_create_resume_certificates_table.php

[Source](../../../application/database/migrations/2026_06_05_111947_create_resume_certificates_table.php)

```php
Schema::create('resume_certificates', function (Blueprint $table) {
$table->id();
$table->foreignId('resume_id')
$table->string('certificate_title');
$table->string('issuer')->nullable();
$table->date('issue_date')->nullable();
$table->string('credential_id')->nullable();
$table->string('credential_url')->nullable();
$table->text('description')->nullable();
$table->string('related_project_title')->nullable();
$table->string('related_project_link')->nullable();
$table->timestamps();
```

## 2026_06_05_114211_add_certificate_file_to_resume_certificates_table.php

[Source](../../../application/database/migrations/2026_06_05_114211_add_certificate_file_to_resume_certificates_table.php)

```php
Schema::table('resume_certificates', function (Blueprint $table) {
$table->string('certificate_file')->nullable()->after('credential_url');
```

## 2026_06_05_132955_add_skill_category_to_resume_skills_table.php

[Source](../../../application/database/migrations/2026_06_05_132955_add_skill_category_to_resume_skills_table.php)

```php
Schema::table('resume_skills', function (Blueprint $table) {
$table->string('skill_category')->nullable()->after('resume_id');
```

## 2026_06_05_135026_create_resume_languages_table.php

[Source](../../../application/database/migrations/2026_06_05_135026_create_resume_languages_table.php)

```php
Schema::create('resume_languages', function (Blueprint $table) {
$table->id();
$table->foreignId('resume_id')
$table->string('language_name');
$table->string('proficiency_level')->nullable();
$table->timestamps();
```

## 2026_06_05_142617_create_resume_interests_table.php

[Source](../../../application/database/migrations/2026_06_05_142617_create_resume_interests_table.php)

```php
Schema::create('resume_interests', function (Blueprint $table) {
$table->id();
$table->foreignId('resume_id')
$table->string('interest_name');
$table->text('description')->nullable();
$table->timestamps();
```

## 2026_06_06_063730_add_description_to_resume_educations_table.php

[Source](../../../application/database/migrations/2026_06_06_063730_add_description_to_resume_educations_table.php)

```php
Schema::table('resume_educations', function (Blueprint $table) {
$table->text('description')->nullable()->after('end_date');
```

## 2026_06_06_094442_add_profile_photo_to_profiles_table.php

[Source](../../../application/database/migrations/2026_06_06_094442_add_profile_photo_to_profiles_table.php)

```php
Schema::table('profiles', function (Blueprint $table) {
$table->string('profile_photo')->nullable()->after('website');
```

## 2026_06_06_112447_add_social_links_to_profiles_table.php

[Source](../../../application/database/migrations/2026_06_06_112447_add_social_links_to_profiles_table.php)

```php
Schema::table('profiles', function (Blueprint $table) {
$table->string('linkedin')->nullable()->after('website');
$table->string('github')->nullable()->after('linkedin');
$table->string('portfolio')->nullable()->after('github');
$table->string('xing')->nullable()->after('portfolio');
```

## 2026_06_06_124823_add_download_options_to_resumes_table.php

[Source](../../../application/database/migrations/2026_06_06_124823_add_download_options_to_resumes_table.php)

```php
Schema::table('resumes', function (Blueprint $table) {
$table->string('uploaded_resume_file')->nullable()->after('resume_password_hash');
$table->enum('download_resume_type', [
```

## 2026_06_06_132633_add_view_tracking_to_resumes_table.php

[Source](../../../application/database/migrations/2026_06_06_132633_add_view_tracking_to_resumes_table.php)

```php
Schema::table('resumes', function (Blueprint $table) {
$table->unsignedInteger('view_count')->default(0)->after('download_resume_type');
$table->timestamp('last_viewed_at')->nullable()->after('view_count');
```

## 2026_07_03_183545_remove_resume_password_from_resumes_table.php

[Source](../../../application/database/migrations/2026_07_03_183545_remove_resume_password_from_resumes_table.php)

```php
Schema::table('resumes', function (Blueprint $table) {
$table->dropColumn('resume_password');
```

## 2026_07_04_121948_add_skill_display_style_to_resumes_table.php

[Source](../../../application/database/migrations/2026_07_04_121948_add_skill_display_style_to_resumes_table.php)

```php
Schema::table('resumes', function (Blueprint $table) {
$table->string('skill_display_style')
```

## 2026_07_06_153015_add_theme_to_resumes_table.php

[Source](../../../application/database/migrations/2026_07_06_153015_add_theme_to_resumes_table.php)

```php
Schema::table('resumes', function (Blueprint $table) {
$table->string('theme')
```

## 2026_07_25_193808_add_personal_information_to_resumes_table.php

[Source](../../../application/database/migrations/2026_07_25_193808_add_personal_information_to_resumes_table.php)

```php
Schema::table('resumes', function (Blueprint $table) {
$table->string('full_name')->nullable()->after('job_position');
$table->string('email')->nullable()->after('full_name');
$table->string('phone', 50)->nullable()->after('email');
$table->text('address')->nullable()->after('phone');
$table->string('postal_code', 30)->nullable()->after('address');
$table->string('city')->nullable()->after('postal_code');
$table->string('country')->nullable()->after('city');
$table->string('website', 2048)->nullable()->after('country');
$table->string('linkedin', 2048)->nullable()->after('website');
$table->string('github', 2048)->nullable()->after('linkedin');
$table->string('profile_photo')->nullable()->after('github');
$table->text('professional_summary')->nullable()->after('profile_photo');
```

## 2026_10_06_000001_add_evidence_url_to_resume_skills_table.php

[Source](../../../application/database/migrations/2026_10_06_000001_add_evidence_url_to_resume_skills_table.php)

```php
Schema::table('resume_skills', function (Blueprint $table) {
$table->string('evidence_url', 2048)->nullable();
```

## 2026_10_06_000002_add_evidence_label_to_resume_skills_table.php

[Source](../../../application/database/migrations/2026_10_06_000002_add_evidence_label_to_resume_skills_table.php)

```php
Schema::table('resume_skills', function (Blueprint $table) {
$table->string('evidence_label', 100)->nullable();
```

## 2026_10_06_000003_add_project_link_label_to_resume_projects_table.php

[Source](../../../application/database/migrations/2026_10_06_000003_add_project_link_label_to_resume_projects_table.php)

```php
Schema::table('resume_projects', function (Blueprint $table) {
$table->string('project_link_label', 100)->nullable();
```

## 2026_10_06_000004_add_demo_link_to_resume_projects_table.php

[Source](../../../application/database/migrations/2026_10_06_000004_add_demo_link_to_resume_projects_table.php)

```php
Schema::table('resume_projects', function (Blueprint $table) {
$table->string('demo_label', 100)->nullable();
$table->string('demo_url', 2048)->nullable();
```
