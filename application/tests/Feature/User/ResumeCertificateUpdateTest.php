<?php

namespace Tests\Feature\User;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ResumeCertificateUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_updating_a_resume_retains_an_existing_certificate_and_its_file(): void
    {
        Storage::fake('private');

        $user = $this->createActiveUser();
        $resume = $this->createResume($user);

        $certificatePath = 'certificate-files/existing-certificate.pdf';

        Storage::disk('private')->put($certificatePath, 'certificate contents');

        $certificate = $resume->certificates()->create([
            'certificate_title' => 'Laravel Certificate',
            'issuer' => 'Laravel',
            'certificate_file' => $certificatePath,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                $this->validUpdateData([
                    'certificates' => [
                        [
                            'id' => $certificate->id,
                            'certificate_title' => 'Laravel Certificate',
                            'issuer' => 'Laravel',
                        ],
                    ],
                ])
            );

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'))
            ->assertSessionHas('success', 'Resume updated successfully.');

        $this->assertDatabaseHas('resume_certificates', [
            'id' => $certificate->id,
            'resume_id' => $resume->id,
            'certificate_title' => 'Laravel Certificate',
            'certificate_file' => $certificatePath,
        ]);

        $this->assertDatabaseCount('resume_certificates', 1);

        Storage::disk('private')->assertExists($certificatePath);
    }

    public function test_replacing_a_certificate_file_deletes_only_the_previous_file(): void
    {
        Storage::fake('private');

        $user = $this->createActiveUser();
        $resume = $this->createResume($user);

        $oldCertificatePath = 'certificate-files/old-certificate.pdf';
        $unrelatedPath = 'certificate-files/unrelated-certificate.pdf';

        Storage::disk('private')->put($oldCertificatePath, 'old certificate');
        Storage::disk('private')->put($unrelatedPath, 'unrelated certificate');

        $certificate = $resume->certificates()->create([
            'certificate_title' => 'Original Certificate',
            'issuer' => 'Original Issuer',
            'certificate_file' => $oldCertificatePath,
        ]);

        $newCertificateFile = UploadedFile::fake()->create(
            'replacement-certificate.pdf',
            100,
            'application/pdf'
        );

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                $this->validUpdateData([
                    'certificates' => [
                        [
                            'id' => $certificate->id,
                            'certificate_title' => 'Updated Certificate',
                            'issuer' => 'Updated Issuer',
                            'certificate_file' => $newCertificateFile,
                        ],
                    ],
                ])
            );

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $updatedCertificate = $resume
            ->certificates()
            ->find($certificate->id);

        $this->assertNotNull($updatedCertificate);
        $this->assertSame(
            'Updated Certificate',
            $updatedCertificate->certificate_title
        );
        $this->assertNotNull($updatedCertificate->certificate_file);
        $this->assertNotSame(
            $oldCertificatePath,
            $updatedCertificate->certificate_file
        );

        $this->assertDatabaseCount('resume_certificates', 1);

        Storage::disk('private')->assertMissing($oldCertificatePath);
        Storage::disk('private')->assertExists(
            $updatedCertificate->certificate_file
        );
        Storage::disk('private')->assertExists($unrelatedPath);
    }

    public function test_removing_a_certificate_deletes_its_record_and_file(): void
    {
        Storage::fake('private');

        $user = $this->createActiveUser();
        $resume = $this->createResume($user);

        $certificatePath = 'certificate-files/removed-certificate.pdf';

        Storage::disk('private')->put($certificatePath, 'certificate contents');

        $certificate = $resume->certificates()->create([
            'certificate_title' => 'Certificate to Remove',
            'issuer' => 'Example Issuer',
            'certificate_file' => $certificatePath,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                $this->validUpdateData([
                    'certificates' => [],
                ])
            );

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $this->assertDatabaseMissing('resume_certificates', [
            'id' => $certificate->id,
        ]);

        Storage::disk('private')->assertMissing($certificatePath);
    }

    public function test_user_cannot_submit_a_certificate_id_from_another_resume(): void
    {
        Storage::fake('private');

        $user = $this->createActiveUser();
        $otherUser = $this->createActiveUser();

        $resume = $this->createResume($user);
        $otherResume = $this->createResume($otherUser);

        $otherCertificatePath = 'certificate-files/other-users-certificate.pdf';

        Storage::disk('private')->put(
            $otherCertificatePath,
            'other certificate contents'
        );

        $otherCertificate = $otherResume->certificates()->create([
            'certificate_title' => 'Other User Certificate',
            'issuer' => 'Other Issuer',
            'certificate_file' => $otherCertificatePath,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('user.resumes.edit', $resume))
            ->put(
                route('user.resumes.update', $resume),
                $this->validUpdateData([
                    'certificates' => [
                        [
                            'id' => $otherCertificate->id,
                            'certificate_title' => 'Forged Certificate',
                            'issuer' => 'Forged Issuer',
                        ],
                    ],
                ])
            );

        $response
            ->assertRedirect(route('user.resumes.edit', $resume))
            ->assertSessionHasErrors('certificates.0.id');

        $this->assertDatabaseHas('resume_certificates', [
            'id' => $otherCertificate->id,
            'resume_id' => $otherResume->id,
            'certificate_title' => 'Other User Certificate',
            'certificate_file' => $otherCertificatePath,
        ]);

        $this->assertDatabaseMissing('resume_certificates', [
            'resume_id' => $resume->id,
            'certificate_title' => 'Forged Certificate',
        ]);

        Storage::disk('private')->assertExists($otherCertificatePath);
    }

    public function test_browser_submitted_certificate_file_path_is_not_trusted(): void
    {
        Storage::fake('private');

        $user = $this->createActiveUser();
        $resume = $this->createResume($user);

        $forgedPath = 'certificate-files/forged-certificate.pdf';

        Storage::disk('private')->put($forgedPath, 'protected file contents');

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                $this->validUpdateData([
                    'certificates' => [
                        [
                            'certificate_title' => 'New Certificate',
                            'issuer' => 'Example Issuer',
                            'existing_certificate_file' => $forgedPath,
                        ],
                    ],
                ])
            );

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $this->assertDatabaseHas('resume_certificates', [
            'resume_id' => $resume->id,
            'certificate_title' => 'New Certificate',
            'certificate_file' => null,
        ]);

        Storage::disk('private')->assertExists($forgedPath);
    }

    private function createActiveUser(): User
    {
        return User::factory()->create([
            'role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }

    private function createResume(User $user): Resume
    {
        return Resume::create([
            'user_id' => $user->id,
            'title' => 'Software Developer Resume',
            'job_position' => 'Software Developer',
            'public_link' => 'r-' . fake()->unique()->lexify('????????'),
            'download_resume_type' => 'generated',
            'skill_display_style' => 'compact',
            'theme' => 'professional_blue',
            'status' => 'active',
        ]);
    }

    private function validUpdateData(array $overrides = []): array
    {
        return array_replace_recursive([
            'title' => 'Updated Software Developer Resume',
            'job_position' => 'Senior Software Developer',
            'status' => 'active',
            'download_resume_type' => 'generated',
            'skill_display_style' => 'compact',
            'theme' => 'professional_blue',
        ], $overrides);
    }
}