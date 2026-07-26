<?php

namespace Tests\Feature\User;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ResumeManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_only_their_own_resumes_on_index_page(): void
    {
        $user = $this->createActiveUser();
        $otherUser = $this->createActiveUser();

        $olderResume = $this->createResume($user, [
            'title' => 'Older Resume',
        ]);

        $olderResume->forceFill([
            'created_at' => now()->subDay(),
        ])->save();

        $newerResume = $this->createResume($user, [
            'title' => 'Newer Resume',
        ]);

        $newerResume->forceFill([
            'created_at' => now(),
        ])->save();

        $otherResume = $this->createResume($otherUser, [
            'title' => 'Other User Resume',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('user.resumes.index'));

        $response
            ->assertOk()
            ->assertViewIs('user.resumes.index')
            ->assertViewHas('resumes', function ($resumes) use (
                $olderResume,
                $newerResume,
                $otherResume
            ) {
                return $resumes->pluck('id')->all() === [
                    $newerResume->id,
                    $olderResume->id,
                ] && ! $resumes->contains('id', $otherResume->id);
            });
    }

    public function test_user_can_view_resume_creation_page(): void
    {
        $user = $this->createActiveUser();

        $response = $this
            ->actingAs($user)
            ->get(route('user.resumes.create'));

        $response
            ->assertOk()
            ->assertViewIs('user.resumes.create');
    }

    public function test_user_can_create_a_core_resume(): void
    {
        $user = $this->createActiveUser();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                'title' => 'Backend Developer Resume',
                'job_position' => 'PHP Developer',
                'resume_password' => 'secret123',
                'download_resume_type' => 'generated',
                'skill_display_style' => 'cards',
                'theme' => 'dark_modern',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'))
            ->assertSessionHas(
                'success',
                'Resume created successfully.'
            );

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertSame(
            'Backend Developer Resume',
            $resume->title
        );

        $this->assertSame(
            'PHP Developer',
            $resume->job_position
        );

        $this->assertSame(
            'generated',
            $resume->download_resume_type
        );

        $this->assertSame(
            'cards',
            $resume->skill_display_style
        );

        $this->assertSame(
            'dark_modern',
            $resume->theme
        );

        $this->assertNotEmpty($resume->public_link);

        $this->assertTrue(
            Hash::check(
                'secret123',
                $resume->resume_password_hash
            )
        );

        $this->assertSame(0, $resume->view_count);
        $this->assertNull($resume->last_viewed_at);
    }

    public function test_each_created_resume_receives_a_unique_public_link(): void
    {
        $user = $this->createActiveUser();

        $this
            ->actingAs($user)
            ->post(
                route('user.resumes.store'),
                $this->storePayload('First Resume')
            )
            ->assertSessionHasNoErrors();

        $this
            ->actingAs($user)
            ->post(
                route('user.resumes.store'),
                $this->storePayload('Second Resume')
            )
            ->assertSessionHasNoErrors();

        $resumes = Resume::where('user_id', $user->id)->get();

        $this->assertCount(2, $resumes);

        $this->assertNotSame(
            $resumes[0]->public_link,
            $resumes[1]->public_link
        );
    }

    public function test_user_can_view_their_resume_edit_page(): void
    {
        $user = $this->createActiveUser();
        $resume = $this->createResume($user);

        $response = $this
            ->actingAs($user)
            ->get(route('user.resumes.edit', $resume));

        $response
            ->assertOk()
            ->assertViewIs('user.resumes.edit')
            ->assertViewHas('resume', function ($viewResume) use (
                $resume
            ) {
                return $viewResume->is($resume)
                    && $viewResume->relationLoaded('skills')
                    && $viewResume->relationLoaded('languages')
                    && $viewResume->relationLoaded('interests')
                    && $viewResume->relationLoaded('educations')
                    && $viewResume->relationLoaded('experiences')
                    && $viewResume->relationLoaded('projects')
                    && $viewResume->relationLoaded('certificates');
            });
    }

    public function test_user_can_update_core_resume_settings(): void
    {
        $user = $this->createActiveUser();
        $resume = $this->createResume($user);

        $originalPublicLink = $resume->public_link;

        $response = $this
            ->actingAs($user)
            ->put(route('user.resumes.update', $resume), [
                'title' => 'Updated Full-Stack Resume',
                'job_position' => 'Senior Full-Stack Developer',
                'status' => 'inactive',
                'download_resume_type' => 'generated',
                'skill_display_style' => 'cards',
                'theme' => 'dark_modern',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'))
            ->assertSessionHas(
                'success',
                'Resume updated successfully.'
            );

        $resume->refresh();

        $this->assertSame(
            'Updated Full-Stack Resume',
            $resume->title
        );

        $this->assertSame(
            'Senior Full-Stack Developer',
            $resume->job_position
        );

        $this->assertSame('inactive', $resume->status);
        $this->assertSame('generated', $resume->download_resume_type);
        $this->assertSame('cards', $resume->skill_display_style);
        $this->assertSame('dark_modern', $resume->theme);

        $this->assertSame(
            $originalPublicLink,
            $resume->public_link
        );
    }

    public function test_invalid_core_resume_settings_are_rejected(): void
    {
        $user = $this->createActiveUser();

        $response = $this
            ->actingAs($user)
            ->from(route('user.resumes.create'))
            ->post(route('user.resumes.store'), [
                'title' => '',
                'resume_password' => '12345',
                'download_resume_type' => 'invalid-option',
                'skill_display_style' => 'invalid-style',
                'theme' => 'invalid-theme',
            ]);

        $response
            ->assertRedirect(route('user.resumes.create'))
            ->assertSessionHasErrors([
                'title',
                'resume_password',
                'download_resume_type',
                'skill_display_style',
                'theme',
            ]);

        $this->assertDatabaseCount('resumes', 0);
    }

    public function test_user_can_upload_a_resume_pdf_during_creation(): void
    {
        Storage::fake('public');

        $user = $this->createActiveUser();

        $uploadedResume = UploadedFile::fake()->create(
            'farhad-resume.pdf',
            500,
            'application/pdf'
        );

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload('Uploaded Resume'),
                'download_resume_type' => 'uploaded',
                'uploaded_resume_file' => $uploadedResume,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertNotNull($resume->uploaded_resume_file);

        Storage::disk('public')->assertExists(
            $resume->uploaded_resume_file
        );
    }

    public function test_replacing_uploaded_resume_deletes_previous_file(): void
    {
        Storage::fake('public');

        $user = $this->createActiveUser();

        $oldFile = UploadedFile::fake()
            ->create('old-resume.pdf', 300, 'application/pdf')
            ->store('uploaded-resumes', 'public');

        $resume = $this->createResume($user, [
            'uploaded_resume_file' => $oldFile,
            'download_resume_type' => 'uploaded',
        ]);

        $newFile = UploadedFile::fake()->create(
            'new-resume.pdf',
            400,
            'application/pdf'
        );

        $response = $this
            ->actingAs($user)
            ->put(route('user.resumes.update', $resume), [
                ...$this->updatePayload(),
                'download_resume_type' => 'uploaded',
                'uploaded_resume_file' => $newFile,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume->refresh();

        Storage::disk('public')->assertMissing($oldFile);

        Storage::disk('public')->assertExists(
            $resume->uploaded_resume_file
        );

        $this->assertNotSame(
            $oldFile,
            $resume->uploaded_resume_file
        );
    }

    public function test_user_can_delete_resume_and_its_uploaded_file(): void
    {
        Storage::fake('public');

        $user = $this->createActiveUser();

        $uploadedFile = UploadedFile::fake()
            ->create('resume.pdf', 300, 'application/pdf')
            ->store('uploaded-resumes', 'public');

        $resume = $this->createResume($user, [
            'uploaded_resume_file' => $uploadedFile,
        ]);

        $response = $this
            ->actingAs($user)
            ->delete(route('user.resumes.destroy', $resume));

        $response
            ->assertRedirect(route('user.resumes.index'))
            ->assertSessionHas(
                'success',
                'Resume deleted successfully.'
            );

        $this->assertDatabaseMissing('resumes', [
            'id' => $resume->id,
        ]);

        Storage::disk('public')->assertMissing($uploadedFile);
    }

    public function test_user_cannot_manage_another_users_resume(): void
    {
        $owner = $this->createActiveUser();
        $otherUser = $this->createActiveUser();

        $resume = $this->createResume($owner);

        $this
            ->actingAs($otherUser)
            ->get(route('user.resumes.edit', $resume))
            ->assertForbidden();

        $this
            ->actingAs($otherUser)
            ->put(
                route('user.resumes.update', $resume),
                $this->updatePayload()
            )
            ->assertForbidden();

        $this
            ->actingAs($otherUser)
            ->delete(route('user.resumes.destroy', $resume))
            ->assertForbidden();

        $this->assertDatabaseHas('resumes', [
            'id' => $resume->id,
            'user_id' => $owner->id,
            'title' => 'Software Developer Resume',
        ]);
    }

    private function createActiveUser(): User
    {
        return User::factory()->create([
            'role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }

    private function storePayload(string $title): array
    {
        return [
            'title' => $title,
            'job_position' => 'Full-Stack Developer',
            'download_resume_type' => 'generated',
            'skill_display_style' => 'compact',
            'theme' => 'professional_blue',
        ];
    }

    private function updatePayload(): array
    {
        return [
            'title' => 'Updated Software Developer Resume',
            'job_position' => 'Senior Full-Stack Developer',
            'status' => 'active',
            'download_resume_type' => 'generated',
            'skill_display_style' => 'compact',
            'theme' => 'professional_blue',
        ];
    }

    private function createResume(
        User $user,
        array $attributes = []
    ): Resume {
        return Resume::create([
            'user_id' => $user->id,
            'title' => 'Software Developer Resume',
            'job_position' => 'Full-Stack Developer',
            'full_name' => 'Farhad Valizadegan',
            'public_link' => 'r-' . strtolower(
                fake()->unique()->lexify('????????')
            ),
            'download_resume_type' => 'generated',
            'skill_display_style' => 'compact',
            'theme' => 'professional_blue',
            'status' => 'active',
            ...$attributes,
        ]);
    }
}