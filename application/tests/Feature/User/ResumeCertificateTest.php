<?php

namespace Tests\Feature\User;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ResumeCertificateTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_resume_with_multiple_certificates(): void
    {
        Storage::fake('private');

        $user = $this->createActiveUser();

        $certificateFile = UploadedFile::fake()->create(
            'laravel-certificate.pdf',
            500,
            'application/pdf'
        );

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'certificates' => [
                    [
                        'certificate_title' => 'Laravel Developer',
                        'issuer' => 'Laravel',
                        'issue_date' => '2026-06-15',
                        'credential_id' => 'LARAVEL-12345',
                        'credential_url' =>
                            'https://example.com/credentials/laravel-12345',
                        'certificate_file' => $certificateFile,
                        'description' =>
                            'Laravel web application development certificate.',
                        'related_project_title' => 'Resume.dev',
                        'related_project_link' =>
                            'https://github.com/example/resume-dev',
                    ],
                    [
                        'certificate_title' => 'React Developer',
                        'issuer' => 'Example Academy',
                        'issue_date' => '2026-07-10',
                        'credential_id' => 'REACT-67890',
                        'credential_url' =>
                            'https://example.com/credentials/react-67890',
                        'description' =>
                            'Modern React and TypeScript development.',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(2, $resume->certificates);

        $laravelCertificate = $resume
            ->certificates()
            ->where('certificate_title', 'Laravel Developer')
            ->firstOrFail();

        $this->assertDatabaseHas('resume_certificates', [
            'id' => $laravelCertificate->id,
            'resume_id' => $resume->id,
            'certificate_title' => 'Laravel Developer',
            'issuer' => 'Laravel',
            'issue_date' => '2026-06-15',
            'credential_id' => 'LARAVEL-12345',
            'credential_url' =>
                'https://example.com/credentials/laravel-12345',
            'description' =>
                'Laravel web application development certificate.',
            'related_project_title' => 'Resume.dev',
            'related_project_link' =>
                'https://github.com/example/resume-dev',
        ]);

        $this->assertNotNull(
            $laravelCertificate->certificate_file
        );

        Storage::disk('private')->assertExists(
            $laravelCertificate->certificate_file
        );

        $this->assertDatabaseHas('resume_certificates', [
            'resume_id' => $resume->id,
            'certificate_title' => 'React Developer',
            'issuer' => 'Example Academy',
            'issue_date' => '2026-07-10',
            'credential_id' => 'REACT-67890',
            'credential_url' =>
                'https://example.com/credentials/react-67890',
            'certificate_file' => null,
            'description' =>
                'Modern React and TypeScript development.',
        ]);
    }

    public function test_certificate_without_title_is_ignored(): void
    {
        Storage::fake('private');

        $user = $this->createActiveUser();

        $ignoredFile = UploadedFile::fake()->create(
            'ignored-certificate.pdf',
            100,
            'application/pdf'
        );

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'certificates' => [
                    [
                        'certificate_title' => '',
                        'issuer' => 'Ignored Issuer',
                        'certificate_file' => $ignoredFile,
                    ],
                    [
                        'certificate_title' => 'Valid Certificate',
                        'issuer' => 'Valid Issuer',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(1, $resume->certificates);

        $this->assertDatabaseHas('resume_certificates', [
            'resume_id' => $resume->id,
            'certificate_title' => 'Valid Certificate',
            'issuer' => 'Valid Issuer',
        ]);

        $this->assertDatabaseMissing('resume_certificates', [
            'resume_id' => $resume->id,
            'issuer' => 'Ignored Issuer',
        ]);

        $this->assertSame(
            [],
            Storage::disk('private')->allFiles('certificate-files')
        );
    }

    public function test_certificate_can_be_created_with_only_a_title(): void
    {
        $user = $this->createActiveUser();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'certificates' => [
                    [
                        'certificate_title' => 'PHP Certificate',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(1, $resume->certificates);

        $this->assertDatabaseHas('resume_certificates', [
            'resume_id' => $resume->id,
            'certificate_title' => 'PHP Certificate',
            'issuer' => null,
            'issue_date' => null,
            'credential_id' => null,
            'credential_url' => null,
            'certificate_file' => null,
            'description' => null,
            'related_project_title' => null,
            'related_project_link' => null,
        ]);
    }

    public function test_invalid_certificate_date_and_urls_are_rejected(): void
    {
        $user = $this->createActiveUser();

        $response = $this
            ->actingAs($user)
            ->from(route('user.resumes.create'))
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'certificates' => [
                    [
                        'certificate_title' => 'Invalid Certificate',
                        'issue_date' => 'not-a-date',
                        'credential_url' => 'not-a-url',
                        'related_project_link' => 'invalid-project-url',
                    ],
                ],
            ]);

        $response
            ->assertRedirect(route('user.resumes.create'))
            ->assertSessionHasErrors([
                'certificates.0.issue_date',
                'certificates.0.credential_url',
                'certificates.0.related_project_link',
            ]);

        $this->assertDatabaseMissing('resumes', [
            'user_id' => $user->id,
            'title' => 'Software Developer Resume',
        ]);

        $this->assertDatabaseCount('resume_certificates', 0);
    }

    public function test_certificate_string_length_limits_are_enforced(): void
    {
        $user = $this->createActiveUser();

        $response = $this
            ->actingAs($user)
            ->from(route('user.resumes.create'))
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'certificates' => [
                    [
                        'certificate_title' => str_repeat('a', 256),
                        'issuer' => str_repeat('b', 256),
                        'credential_id' => str_repeat('c', 256),
                        'credential_url' =>
                            'https://example.com/' . str_repeat('d', 240),
                        'related_project_title' => str_repeat('e', 256),
                        'related_project_link' =>
                            'https://example.com/' . str_repeat('f', 240),
                    ],
                ],
            ]);

        $response
            ->assertRedirect(route('user.resumes.create'))
            ->assertSessionHasErrors([
                'certificates.0.certificate_title',
                'certificates.0.issuer',
                'certificates.0.credential_id',
                'certificates.0.credential_url',
                'certificates.0.related_project_title',
                'certificates.0.related_project_link',
            ]);

        $this->assertDatabaseMissing('resumes', [
            'user_id' => $user->id,
            'title' => 'Software Developer Resume',
        ]);

        $this->assertDatabaseCount('resume_certificates', 0);
    }

    public function test_invalid_and_oversized_certificate_files_are_rejected(): void
    {
        Storage::fake('private');

        $user = $this->createActiveUser();

        $invalidFile = UploadedFile::fake()->create(
            'certificate.txt',
            100,
            'text/plain'
        );

        $oversizedFile = UploadedFile::fake()->create(
            'large-certificate.pdf',
            4097,
            'application/pdf'
        );

        $response = $this
            ->actingAs($user)
            ->from(route('user.resumes.create'))
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'certificates' => [
                    [
                        'certificate_title' => 'Invalid File Type',
                        'certificate_file' => $invalidFile,
                    ],
                    [
                        'certificate_title' => 'Oversized File',
                        'certificate_file' => $oversizedFile,
                    ],
                ],
            ]);

        $response
            ->assertRedirect(route('user.resumes.create'))
            ->assertSessionHasErrors([
                'certificates.0.certificate_file',
                'certificates.1.certificate_file',
            ]);

        $this->assertDatabaseMissing('resumes', [
            'user_id' => $user->id,
            'title' => 'Software Developer Resume',
        ]);

        $this->assertDatabaseCount('resume_certificates', 0);

        $this->assertSame(
            [],
            Storage::disk('private')->allFiles('certificate-files')
        );
    }

    private function createActiveUser(): User
    {
        return User::factory()->create([
            'role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }

    private function storePayload(): array
    {
        return [
            'title' => 'Software Developer Resume',
            'job_position' => 'Full-Stack Developer',
            'download_resume_type' => 'generated',
            'skill_display_style' => 'compact',
            'theme' => 'professional_blue',
        ];
    }
}