<?php

namespace Tests\Feature\User;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ResumePersonalInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_resume_with_personal_information_and_profile_photo(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $photo = UploadedFile::fake()->image(
            'profile-photo.jpg',
            400,
            400
        );

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'full_name' => 'Farhad Valizadegan',
                'email' => 'farhad@example.com',
                'phone' => '+49 123 456789',
                'address' => 'Sample Street 10',
                'postal_code' => '91052',
                'city' => 'Erlangen',
                'country' => 'Germany',
                'website' => 'https://example.com',
                'linkedin' => 'https://www.linkedin.com/in/farhad',
                'github' => 'https://github.com/farhad',
                'professional_summary' =>
                    'Full-stack developer specializing in Laravel.',
                'profile_photo' => $photo,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)->firstOrFail();

        $this->assertSame(
            'Farhad Valizadegan',
            $resume->full_name
        );
        $this->assertSame(
            'farhad@example.com',
            $resume->email
        );
        $this->assertSame(
            '+49 123 456789',
            $resume->phone
        );
        $this->assertSame(
            'Sample Street 10',
            $resume->address
        );
        $this->assertSame('91052', $resume->postal_code);
        $this->assertSame('Erlangen', $resume->city);
        $this->assertSame('Germany', $resume->country);
        $this->assertSame(
            'https://example.com',
            $resume->website
        );
        $this->assertSame(
            'https://www.linkedin.com/in/farhad',
            $resume->linkedin
        );
        $this->assertSame(
            'https://github.com/farhad',
            $resume->github
        );
        $this->assertSame(
            'Full-stack developer specializing in Laravel.',
            $resume->professional_summary
        );

        $this->assertNotNull($resume->profile_photo);
        Storage::disk('public')->assertExists(
            $resume->profile_photo
        );
    }

    public function test_user_can_update_resume_personal_information(): void
    {
        $user = User::factory()->create();
        $resume = $this->createResume($user);

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                [
                    ...$this->updatePayload(),
                    'full_name' => 'Freddie Valizadegan',
                    'email' => 'freddie@example.com',
                    'phone' => '+49 987 654321',
                    'address' => 'Updated Street 20',
                    'postal_code' => '90402',
                    'city' => 'Nuremberg',
                    'country' => 'Germany',
                    'website' => 'https://freddie.example.com',
                    'linkedin' =>
                        'https://www.linkedin.com/in/freddie',
                    'github' =>
                        'https://github.com/freddie',
                    'professional_summary' =>
                        'Updated professional summary.',
                ]
            );

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume->refresh();

        $this->assertSame(
            'Freddie Valizadegan',
            $resume->full_name
        );
        $this->assertSame(
            'freddie@example.com',
            $resume->email
        );
        $this->assertSame(
            '+49 987 654321',
            $resume->phone
        );
        $this->assertSame(
            'Updated Street 20',
            $resume->address
        );
        $this->assertSame('90402', $resume->postal_code);
        $this->assertSame('Nuremberg', $resume->city);
        $this->assertSame('Germany', $resume->country);
        $this->assertSame(
            'https://freddie.example.com',
            $resume->website
        );
        $this->assertSame(
            'https://www.linkedin.com/in/freddie',
            $resume->linkedin
        );
        $this->assertSame(
            'https://github.com/freddie',
            $resume->github
        );
        $this->assertSame(
            'Updated professional summary.',
            $resume->professional_summary
        );
    }

    public function test_updating_resume_without_new_photo_retains_existing_photo(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $existingPhoto = UploadedFile::fake()
            ->image('existing-photo.jpg')
            ->store('resume-profile-photos', 'public');

        $resume = $this->createResume($user, [
            'profile_photo' => $existingPhoto,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                $this->updatePayload()
            );

        $response->assertSessionHasNoErrors();

        $resume->refresh();

        $this->assertSame(
            $existingPhoto,
            $resume->profile_photo
        );
        Storage::disk('public')->assertExists($existingPhoto);
    }

    public function test_replacing_profile_photo_deletes_previous_photo(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $oldPhoto = UploadedFile::fake()
            ->image('old-photo.jpg')
            ->store('resume-profile-photos', 'public');

        $resume = $this->createResume($user, [
            'profile_photo' => $oldPhoto,
        ]);

        $newPhoto = UploadedFile::fake()->image(
            'new-photo.png',
            500,
            500
        );

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                [
                    ...$this->updatePayload(),
                    'profile_photo' => $newPhoto,
                ]
            );

        $response->assertSessionHasNoErrors();

        $resume->refresh();

        $this->assertNotNull($resume->profile_photo);
        $this->assertNotSame(
            $oldPhoto,
            $resume->profile_photo
        );

        Storage::disk('public')->assertMissing($oldPhoto);
        Storage::disk('public')->assertExists(
            $resume->profile_photo
        );
    }

    public function test_user_can_remove_existing_profile_photo(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $photo = UploadedFile::fake()
            ->image('profile-photo.webp')
            ->store('resume-profile-photos', 'public');

        $resume = $this->createResume($user, [
            'profile_photo' => $photo,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                [
                    ...$this->updatePayload(),
                    'remove_profile_photo' => true,
                ]
            );

        $response->assertSessionHasNoErrors();

        $resume->refresh();

        $this->assertNull($resume->profile_photo);
        Storage::disk('public')->assertMissing($photo);
    }

    public function test_deleting_resume_deletes_profile_photo(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $photo = UploadedFile::fake()
            ->image('profile-photo.jpg')
            ->store('resume-profile-photos', 'public');

        $resume = $this->createResume($user, [
            'profile_photo' => $photo,
        ]);

        $response = $this
            ->actingAs($user)
            ->delete(route('user.resumes.destroy', $resume));

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $this->assertDatabaseMissing('resumes', [
            'id' => $resume->id,
        ]);

        Storage::disk('public')->assertMissing($photo);
    }

    public function test_personal_information_urls_and_email_are_validated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'email' => 'not-an-email',
                'website' => 'not-a-url',
                'linkedin' => 'invalid-linkedin-url',
                'github' => 'invalid-github-url',
            ]);

        $response->assertSessionHasErrors([
            'email',
            'website',
            'linkedin',
            'github',
        ]);

        $this->assertDatabaseCount('resumes', 0);
    }

    public function test_invalid_profile_photo_is_rejected(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $invalidPhoto = UploadedFile::fake()->create(
            'profile-photo.pdf',
            100,
            'application/pdf'
        );

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'profile_photo' => $invalidPhoto,
            ]);

        $response->assertSessionHasErrors('profile_photo');

        $this->assertDatabaseCount('resumes', 0);
    }

    public function test_user_cannot_update_another_users_personal_information(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $resume = $this->createResume($owner);

        $response = $this
            ->actingAs($otherUser)
            ->put(
                route('user.resumes.update', $resume),
                [
                    ...$this->updatePayload(),
                    'full_name' => 'Unauthorized Change',
                ]
            );

        $response->assertForbidden();

        $this->assertNotSame(
            'Unauthorized Change',
            $resume->fresh()->full_name
        );
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
            'public_link' => 'r-' . strtolower(fake()->unique()->lexify(
                '????????'
            )),
            'download_resume_type' => 'generated',
            'skill_display_style' => 'compact',
            'theme' => 'professional_blue',
            'status' => 'active',
            ...$attributes,
        ]);
    }
}