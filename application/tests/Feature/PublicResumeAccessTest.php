<?php

namespace Tests\Feature;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PublicResumeAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_active_resume_password_page_is_publicly_accessible(): void
    {
        $resume = $this->createResume();

        $response = $this->get(
            route('public.resume.password', $resume->public_link)
        );

        $response
            ->assertOk()
            ->assertViewIs('public.resume-password')
            ->assertViewHas('resume', function (Resume $viewResume) use ($resume) {
                return $viewResume->is($resume);
            });
    }

    public function test_inactive_resume_password_page_returns_not_found(): void
    {
        $resume = $this->createResume([
            'status' => 'inactive',
        ]);

        $this
            ->get(route('public.resume.password', $resume->public_link))
            ->assertNotFound();
    }

    public function test_resume_password_is_required(): void
    {
        $resume = $this->createResume([
            'resume_password_hash' => Hash::make('secret123'),
        ]);

        $response = $this->post(
            route('public.resume.verify', $resume->public_link),
            []
        );

        $response
            ->assertRedirect()
            ->assertSessionHasErrors('resume_password');
    }

    public function test_resume_without_password_is_accessible(): void
    {
        $resume = $this->createResume([
            'resume_password_hash' => null,
        ]);

        $response = $this
            ->from(route('public.resume.password', $resume->public_link))
            ->post(
                route('public.resume.verify', $resume->public_link),
                ['resume_password' => 'secret123']
            );

        $response
            ->assertRedirect(route('public.resume.view', $resume->public_link));
    }

    public function test_incorrect_resume_password_is_rejected(): void
    {
        $resume = $this->createResume([
            'resume_password_hash' => Hash::make('correct-password'),
        ]);

        $response = $this
            ->from(route('public.resume.password', $resume->public_link))
            ->post(
                route('public.resume.verify', $resume->public_link),
                ['resume_password' => 'wrong-password']
            );

        $response
            ->assertRedirect(
                route('public.resume.password', $resume->public_link)
            )
            ->assertSessionHas('error', 'Incorrect password.')
            ->assertSessionMissing(
                'public_resume_access_' . $resume->id
            );
    }

    public function test_correct_password_grants_public_resume_access(): void
    {
        $resume = $this->createResume([
            'resume_password_hash' => Hash::make('secret123'),
        ]);

        $response = $this->post(
            route('public.resume.verify', $resume->public_link),
            ['resume_password' => 'secret123']
        );

        $response
            ->assertRedirect(
                route('public.resume.view', $resume->public_link)
            )
            ->assertSessionHas(
                'public_resume_access_' . $resume->id,
                $resume->publicAccessToken()
            );
    }

    public function test_public_resume_view_requires_verified_session_access(): void
    {
        $resume = $this->createResume([
            'view_count' => 5,
        ]);

        $response = $this->get(
            route('public.resume.view', $resume->public_link)
        );

        $response->assertRedirect(
            route('public.resume.password', $resume->public_link)
        );

        $resume->refresh();

        $this->assertSame(5, (int) $resume->view_count);
        $this->assertNull($resume->last_viewed_at);
    }

    public function test_authorized_visitor_can_view_resume_and_view_is_tracked(): void
    {
        $resume = $this->createResume([
            'view_count' => 5,
            'last_viewed_at' => null,
        ]);

        $response = $this
            ->withSession([
                'public_resume_access_' . $resume->id => $resume->publicAccessToken(),
            ])
            ->get(route('public.resume.view', $resume->public_link));

        $response
            ->assertOk()
            ->assertViewIs('public.resume-view')
            ->assertViewHas('resume');

        $resume->refresh();

        $this->assertSame(6, (int) $resume->view_count);
        $this->assertNotNull($resume->last_viewed_at);
    }

    public function test_inactive_resume_view_returns_not_found(): void
    {
        $resume = $this->createResume([
            'status' => 'inactive',
        ]);

        $this
            ->withSession([
                'public_resume_access_' . $resume->id => $resume->publicAccessToken(),
            ])
            ->get(route('public.resume.view', $resume->public_link))
            ->assertNotFound();
    }

    public function test_generated_pdf_download_requires_verified_access(): void
    {
        $resume = $this->createResume([
            'download_resume_type' => 'generated',
        ]);

        $this
            ->get(route(
                'public.resume.download-generated-pdf',
                $resume->public_link
            ))
            ->assertRedirect(
                route('public.resume.password', $resume->public_link)
            );
    }

    public function test_generated_pdf_download_returns_forbidden_when_disabled(): void
    {
        $resume = $this->createResume([
            'download_resume_type' => 'uploaded',
        ]);

        $this
            ->withSession([
                'public_resume_access_' . $resume->id => $resume->publicAccessToken(),
            ])
            ->get(route(
                'public.resume.download-generated-pdf',
                $resume->public_link
            ))
            ->assertForbidden();
    }

    public function test_authorized_visitor_can_download_generated_pdf(): void
    {
        $resume = $this->createResume([
            'download_resume_type' => 'generated',
        ]);

        $response = $this
            ->withSession([
                'public_resume_access_' . $resume->id => $resume->publicAccessToken(),
            ])
            ->get(route(
                'public.resume.download-generated-pdf',
                $resume->public_link
            ));

        $response
            ->assertOk()
            ->assertDownload('farhad-valizadegan-generated-resume.pdf');

        $this->assertStringContainsString(
            'application/pdf',
            (string) $response->headers->get('content-type')
        );
    }

    public function test_uploaded_pdf_download_requires_verified_access(): void
    {
        $resume = $this->createResume([
            'download_resume_type' => 'uploaded',
            'uploaded_resume_file' => 'uploaded-resumes/resume.pdf',
        ]);

        $this
            ->get(route(
                'public.resume.download-uploaded-pdf',
                $resume->public_link
            ))
            ->assertRedirect(
                route('public.resume.password', $resume->public_link)
            );
    }

    public function test_uploaded_pdf_download_returns_forbidden_when_disabled(): void
    {
        $resume = $this->createResume([
            'download_resume_type' => 'generated',
        ]);

        $this
            ->withSession([
                'public_resume_access_' . $resume->id => $resume->publicAccessToken(),
            ])
            ->get(route(
                'public.resume.download-uploaded-pdf',
                $resume->public_link
            ))
            ->assertForbidden();
    }

    public function test_uploaded_pdf_download_returns_not_found_when_file_is_missing(): void
    {
        Storage::fake('private');

        $resume = $this->createResume([
            'download_resume_type' => 'uploaded',
            'uploaded_resume_file' => 'uploaded-resumes/missing.pdf',
        ]);

        $this
            ->withSession([
                'public_resume_access_' . $resume->id => $resume->publicAccessToken(),
            ])
            ->get(route(
                'public.resume.download-uploaded-pdf',
                $resume->public_link
            ))
            ->assertNotFound();
    }

    public function test_authorized_visitor_can_download_uploaded_pdf(): void
    {
        Storage::fake('private');

        $filePath = 'uploaded-resumes/farhad-resume.pdf';

        Storage::disk('private')->put(
            $filePath,
            '%PDF-1.4 test resume content'
        );

        $resume = $this->createResume([
            'download_resume_type' => 'uploaded',
            'uploaded_resume_file' => $filePath,
        ]);

        $response = $this
            ->withSession([
                'public_resume_access_' . $resume->id => $resume->publicAccessToken(),
            ])
            ->get(route(
                'public.resume.download-uploaded-pdf',
                $resume->public_link
            ));

        $response
            ->assertOk()
            ->assertDownload('farhad-valizadegan-uploaded-resume.pdf');

        Storage::disk('private')->assertExists($filePath);
    }

    private function createResume(array $attributes = []): Resume
    {
        $user = User::factory()->create([
            'name' => 'Farhad Valizadegan',
            'role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        return Resume::create([
            'user_id' => $user->id,
            'title' => 'Software Developer Resume',
            'job_position' => 'Full-Stack Developer',
            'full_name' => 'Farhad Valizadegan',
            'email' => 'farhad@example.com',
            'public_link' => 'r-' . strtolower(
                fake()->unique()->lexify('????????')
            ),
            'resume_password_hash' => Hash::make('secret123'),
            'download_resume_type' => 'generated',
            'skill_display_style' => 'compact',
            'theme' => 'professional_blue',
            'view_count' => 0,
            'last_viewed_at' => null,
            'status' => 'active',
            ...$attributes,
        ]);
    }
}