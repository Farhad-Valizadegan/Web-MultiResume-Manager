<?php

namespace Tests\Feature\User;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResumeLanguageTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_resume_with_multiple_language_records(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'languages' => [
                    [
                        'language_name' => 'English',
                        'proficiency_level' => 'B2',
                    ],
                    [
                        'language_name' => 'German',
                        'proficiency_level' => 'A2',
                    ],
                    [
                        'language_name' => 'Persian',
                        'proficiency_level' => 'Native',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(3, $resume->languages);

        $this->assertDatabaseHas('resume_languages', [
            'resume_id' => $resume->id,
            'language_name' => 'English',
            'proficiency_level' => 'B2',
        ]);

        $this->assertDatabaseHas('resume_languages', [
            'resume_id' => $resume->id,
            'language_name' => 'German',
            'proficiency_level' => 'A2',
        ]);

        $this->assertDatabaseHas('resume_languages', [
            'resume_id' => $resume->id,
            'language_name' => 'Persian',
            'proficiency_level' => 'Native',
        ]);
    }

    public function test_language_without_name_is_ignored(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'languages' => [
                    [
                        'language_name' => '',
                        'proficiency_level' => 'C2',
                    ],
                    [
                        'language_name' => 'German',
                        'proficiency_level' => 'A2',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(1, $resume->languages);

        $this->assertDatabaseHas('resume_languages', [
            'resume_id' => $resume->id,
            'language_name' => 'German',
            'proficiency_level' => 'A2',
        ]);

        $this->assertDatabaseMissing('resume_languages', [
            'resume_id' => $resume->id,
            'language_name' => '',
            'proficiency_level' => 'C2',
        ]);
    }

    public function test_language_can_be_created_without_proficiency_level(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'languages' => [
                    [
                        'language_name' => 'French',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(1, $resume->languages);

        $this->assertDatabaseHas('resume_languages', [
            'resume_id' => $resume->id,
            'language_name' => 'French',
            'proficiency_level' => null,
        ]);
    }

    public function test_language_fields_longer_than_255_characters_are_rejected(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from(route('user.resumes.create'))
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'languages' => [
                    [
                        'language_name' => str_repeat('a', 256),
                        'proficiency_level' => str_repeat('b', 256),
                    ],
                ],
            ]);

        $response
            ->assertRedirect(route('user.resumes.create'))
            ->assertSessionHasErrors([
                'languages.0.language_name',
                'languages.0.proficiency_level',
            ]);

        $this->assertDatabaseMissing('resumes', [
            'user_id' => $user->id,
            'title' => 'Software Developer Resume',
        ]);

        $this->assertDatabaseCount('resume_languages', 0);
    }

    public function test_updating_resume_replaces_existing_language_records(): void
    {
        $user = User::factory()->create();
        $resume = $this->createResume($user);

        $oldLanguage = $resume->languages()->create([
            'language_name' => 'Old Language',
            'proficiency_level' => 'Beginner',
        ]);

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                [
                    ...$this->updatePayload(),
                    'languages' => [
                        [
                            'language_name' => 'English',
                            'proficiency_level' => 'B2',
                        ],
                        [
                            'language_name' => 'German',
                            'proficiency_level' => 'A2',
                        ],
                    ],
                ]
            );

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume->refresh();

        $this->assertCount(2, $resume->languages);

        $this->assertDatabaseMissing('resume_languages', [
            'id' => $oldLanguage->id,
        ]);

        $this->assertDatabaseHas('resume_languages', [
            'resume_id' => $resume->id,
            'language_name' => 'English',
            'proficiency_level' => 'B2',
        ]);

        $this->assertDatabaseHas('resume_languages', [
            'resume_id' => $resume->id,
            'language_name' => 'German',
            'proficiency_level' => 'A2',
        ]);
    }

    public function test_updating_resume_without_languages_removes_existing_records(): void
    {
        $user = User::factory()->create();
        $resume = $this->createResume($user);

        $language = $resume->languages()->create([
            'language_name' => 'English',
            'proficiency_level' => 'B2',
        ]);

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                $this->updatePayload()
            );

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $this->assertDatabaseMissing('resume_languages', [
            'id' => $language->id,
        ]);

        $this->assertCount(
            0,
            $resume->fresh()->languages
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