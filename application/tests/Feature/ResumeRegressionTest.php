<?php

namespace Tests\Feature;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ResumeRegressionTest extends TestCase
{
    use RefreshDatabase;

    private function resume(User $user, array $attributes = []): Resume
    {
        return $user->resumes()->create(array_merge([
            'title' => 'Developer Resume', 'public_link' => 'r-regression',
            'status' => 'active', 'download_resume_type' => 'generated',
            'skill_display_style' => 'compact', 'theme' => 'professional_blue',
            'resume_password_hash' => Hash::make('original-password'),
        ], $attributes));
    }

    private function payload(array $attributes = []): array
    {
        return array_merge([
            'title' => 'Developer Resume', 'status' => 'active',
            'download_resume_type' => 'generated', 'skill_display_style' => 'compact',
            'theme' => 'professional_blue',
        ], $attributes);
    }

    public function test_inactive_account_cannot_log_in(): void
    {
        $user = User::factory()->create(['status' => 'inactive']);
        $this->post('/login', ['email' => $user->email, 'password' => 'password'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_deactivation_blocks_existing_session_and_profile(): void
    {
        $user = User::factory()->create(['status' => 'inactive']);
        $this->actingAs($user)->get('/profile')->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_password_free_resume_can_be_viewed_without_a_session_grant(): void
    {
        $resume = $this->resume(User::factory()->create(), ['resume_password_hash' => null]);
        $this->get(route('public.resume.password', $resume->public_link))
            ->assertRedirect(route('public.resume.view', $resume->public_link));
        $this->get(route('public.resume.view', $resume->public_link))->assertOk();
    }

    public function test_public_page_uses_resume_information_instead_of_account_information(): void
    {
        $user = User::factory()->create(['name' => 'Private Account Name', 'email' => 'private@example.com']);
        $resume = $this->resume($user, [
            'resume_password_hash' => null, 'full_name' => 'Public Resume Name',
            'email' => 'public@example.com', 'professional_summary' => 'Tailored summary',
        ]);
        $this->get(route('public.resume.view', $resume->public_link))
            ->assertOk()->assertSee('Public Resume Name')->assertSee('public@example.com')
            ->assertSee('Tailored summary')->assertDontSee('private@example.com')
            ->assertDontSee('Private Account Name');
        $html = view('public.resume-pdf', compact('resume'))->render();
        $this->assertStringContainsString('Public Resume Name', $html);
        $this->assertStringNotContainsString('private@example.com', $html);
    }

    public function test_changing_password_revokes_previously_granted_access(): void
    {
        $resume = $this->resume(User::factory()->create());
        $this->post(route('public.resume.verify', $resume->public_link), ['resume_password' => 'original-password']);
        $resume->update(['resume_password_hash' => Hash::make('replacement-password')]);
        $this->get(route('public.resume.view', $resume->public_link))
            ->assertRedirect(route('public.resume.password', $resume->public_link));
    }

    public function test_public_password_attempts_are_limited(): void
    {
        $resume = $this->resume(User::factory()->create());
        for ($attempt = 0; $attempt < 10; $attempt++) {
            $this->post(route('public.resume.verify', $resume->public_link), ['resume_password' => 'wrong']);
        }
        $this->post(route('public.resume.verify', $resume->public_link), ['resume_password' => 'wrong'])
            ->assertStatus(429);
    }

    public function test_profile_validation_failure_does_not_change_account(): void
    {
        $user = User::factory()->create(['name' => 'Original Name']);
        $this->actingAs($user)->patch('/profile', [
            'name' => 'Changed Name', 'email' => $user->email, 'website' => 'invalid',
        ])->assertSessionHasErrors('website');
        $this->assertSame('Original Name', $user->fresh()->name);
    }

    public function test_only_administrator_cannot_remove_their_admin_role(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->put(route('admin.users.update', $admin), [
            'name' => $admin->name, 'email' => $admin->email, 'role' => 'user', 'status' => 'active',
        ])->assertSessionHasErrors('role');
        $this->assertSame('admin', $admin->fresh()->role);
    }

    public function test_resume_password_confirmation_must_match(): void
    {
        $user = User::factory()->create();
        $resume = $this->resume($user);
        $this->actingAs($user)->put(route('user.resumes.updatePassword', $resume), [
            'resume_password' => 'new-password', 'resume_password_confirmation' => 'different-password',
        ])->assertSessionHasErrors('resume_password');
        $this->assertTrue(Hash::check('original-password', $resume->fresh()->resume_password_hash));
    }

    public function test_failed_form_restores_all_submitted_skill_rows(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->from(route('user.resumes.create'))->post(route('user.resumes.store'), $this->payload([
            'title' => '', 'skills' => [['skill_name' => 'Preserved Laravel'], ['skill_name' => 'Preserved PHP']],
        ]))->assertSessionHasErrors('title');
        $this->get(route('user.resumes.create'))->assertSee('Preserved Laravel')->assertSee('Preserved PHP');
    }

    public function test_uploaded_resume_is_private(): void
    {
        Storage::fake('public');
        Storage::fake('private');
        $user = User::factory()->create();
        $this->actingAs($user)->post(route('user.resumes.store'), $this->payload([
            'download_resume_type' => 'uploaded',
            'uploaded_resume_file' => UploadedFile::fake()->create('resume.pdf', 10, 'application/pdf'),
        ]))->assertSessionHasNoErrors();
        $path = $user->resumes()->firstOrFail()->uploaded_resume_file;
        Storage::disk('private')->assertExists($path);
        Storage::disk('public')->assertMissing($path);
    }

    public function test_admin_deletion_removes_resume_files(): void
    {
        Storage::fake('private');
        $admin = User::factory()->create(['role' => 'admin']);
        $resume = $this->resume(User::factory()->create(), ['uploaded_resume_file' => 'uploaded-resumes/test.pdf']);
        Storage::disk('private')->put($resume->uploaded_resume_file, 'file content');
        $this->actingAs($admin)->delete(route('admin.resumes.destroy', $resume))->assertRedirect();
        Storage::disk('private')->assertMissing('uploaded-resumes/test.pdf');
    }

    public function test_private_file_access_obeys_password_owner_and_download_settings(): void
    {
        Storage::fake('private');
        $user = User::factory()->create();
        $resume = $this->resume($user, ['uploaded_resume_file' => 'uploaded-resumes/test.pdf', 'download_resume_type' => 'uploaded']);
        Storage::disk('private')->put($resume->uploaded_resume_file, '%PDF-1.4 content');
        $url = route('resume.files.show', [$resume, 'uploaded']);
        $this->get($url)->assertForbidden();
        $this->post(route('public.resume.verify', $resume->public_link), ['resume_password' => 'original-password']);
        $this->get($url)->assertOk();
        $resume->update(['download_resume_type' => 'generated']);
        $this->get($url)->assertForbidden();
        $this->actingAs($user)->get($url)->assertOk();
    }

    public function test_certificate_route_cannot_read_a_different_resumes_certificate(): void
    {
        Storage::fake('private');
        $user = User::factory()->create();
        $resume = $this->resume($user);
        $other = $this->resume(User::factory()->create(), ['public_link' => 'r-other']);
        $certificate = $other->certificates()->create(['certificate_title' => 'Private certificate', 'certificate_file' => 'certificate-files/private.pdf']);
        Storage::disk('private')->put($certificate->certificate_file, 'private content');
        $this->actingAs($user)->get(route('resume.files.show', [$resume, 'certificate', $certificate->id]))->assertNotFound();
    }

    public function test_user_deletion_cleans_all_resume_files(): void
    {
        Storage::fake('public');
        Storage::fake('private');
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();
        $user->profile()->create(['profile_photo' => 'profile-photos/account.jpg']);
        Storage::disk('public')->put('profile-photos/account.jpg', 'account image');
        $resume = $this->resume($user, ['uploaded_resume_file' => 'uploaded-resumes/test.pdf', 'profile_photo' => 'resume-profile-photos/test.jpg']);
        $resume->certificates()->create(['certificate_title' => 'Certificate', 'certificate_file' => 'certificate-files/test.pdf']);
        foreach (['uploaded-resumes/test.pdf', 'resume-profile-photos/test.jpg', 'certificate-files/test.pdf'] as $path) {
            Storage::disk('private')->put($path, 'content');
        }
        $this->actingAs($admin)->delete(route('admin.users.destroy', $user))->assertRedirect();
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertSame([], Storage::disk('private')->allFiles());
        Storage::disk('public')->assertMissing('profile-photos/account.jpg');
    }

    public function test_failed_update_rolls_back_database_and_preserves_original_files(): void
    {
        Storage::fake('private');
        $user = User::factory()->create();
        $resume = $this->resume($user, ['uploaded_resume_file' => 'uploaded-resumes/original.pdf']);
        Storage::disk('private')->put($resume->uploaded_resume_file, 'original');
        $skill = $resume->skills()->create(['skill_name' => 'Original Skill']);
        \App\Models\ResumeSkill::creating(function () { throw new \RuntimeException('Simulated storage record failure'); });
        $this->withoutExceptionHandling();
        try {
            $this->actingAs($user)->put(route('user.resumes.update', $resume), $this->payload([
                'title' => 'Must roll back', 'skills' => [['skill_name' => 'Replacement Skill']],
                'uploaded_resume_file' => UploadedFile::fake()->create('replacement.pdf', 10, 'application/pdf'),
            ]));
            $this->fail('Expected the simulated failure.');
        } catch (\RuntimeException $exception) {
            $this->assertSame('Simulated storage record failure', $exception->getMessage());
        }
        $this->assertSame('Developer Resume', $resume->fresh()->title);
        $this->assertDatabaseHas('resume_skills', ['id' => $skill->id, 'skill_name' => 'Original Skill']);
        $this->assertSame(['uploaded-resumes/original.pdf'], Storage::disk('private')->allFiles());
    }

    public function test_file_migration_preserves_content_and_removes_public_copy(): void
    {
        Storage::fake('public');
        Storage::fake('private');
        Storage::disk('public')->put('uploaded-resumes/legacy.pdf', 'legacy content');
        Storage::disk('public')->put('profile-photos/account.jpg', 'public account image');
        $this->artisan('resumes:protect-files')->assertSuccessful();
        $this->assertSame('legacy content', Storage::disk('private')->get('uploaded-resumes/legacy.pdf'));
        Storage::disk('public')->assertMissing('uploaded-resumes/legacy.pdf');
        Storage::disk('public')->assertExists('profile-photos/account.jpg');
        $this->artisan('resumes:protect-files')->assertSuccessful();
    }

    public function test_failed_edit_retains_sparse_certificate_ids_and_removed_rows(): void
    {
        $user = User::factory()->create();
        $resume = $this->resume($user);
        $certificate = $resume->certificates()->create(['certificate_title' => 'Original certificate']);
        $this->actingAs($user)->from(route('user.resumes.edit', $resume))
            ->put(route('user.resumes.update', $resume), $this->payload([
                'title' => '', 'certificates' => [7 => ['id' => $certificate->id, 'certificate_title' => 'Restored certificate']],
                'languages' => [3 => ['language_name' => 'Restored language']],
            ]))->assertSessionHasErrors('title');
        $this->get(route('user.resumes.edit', $resume))->assertOk()->assertSee('Restored certificate')
            ->assertSee('certificates[7][id]', false)->assertSee('Restored language');
    }

    public function test_last_administrator_cannot_delete_their_account(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->delete('/profile', ['password' => 'password'])->assertSessionHasErrorsIn('userDeletion', 'password');
        $this->assertAuthenticatedAs($admin);
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }
}
