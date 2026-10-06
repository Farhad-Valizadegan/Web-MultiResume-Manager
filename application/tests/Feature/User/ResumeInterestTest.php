<?php

namespace Tests\Feature\User;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResumeInterestTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_resume_with_multiple_interest_records(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'interests' => [
                    [
                        'interest_name' => 'Artificial Intelligence',
                        'description' => 'Learning machine learning and NLP.',
                    ],
                    [
                        'interest_name' => 'Open-Source Development',
                        'description' => 'Contributing to software projects.',
                    ],
                    [
                        'interest_name' => 'Fitness',
                        'description' => 'Strength and endurance training.',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(3, $resume->interests);

        $this->assertDatabaseHas('resume_interests', [
            'resume_id' => $resume->id,
            'interest_name' => 'Artificial Intelligence',
            'description' => 'Learning machine learning and NLP.',
        ]);

        $this->assertDatabaseHas('resume_interests', [
            'resume_id' => $resume->id,
            'interest_name' => 'Open-Source Development',
            'description' => 'Contributing to software projects.',
        ]);

        $this->assertDatabaseHas('resume_interests', [
            'resume_id' => $resume->id,
            'interest_name' => 'Fitness',
            'description' => 'Strength and endurance training.',
        ]);
    }

    public function test_interest_without_name_is_ignored(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'interests' => [
                    [
                        'interest_name' => '',
                        'description' => 'This entry should be ignored.',
                    ],
                    [
                        'interest_name' => 'Photography',
                        'description' => 'Landscape photography.',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(1, $resume->interests);

        $this->assertDatabaseHas('resume_interests', [
            'resume_id' => $resume->id,
            'interest_name' => 'Photography',
            'description' => 'Landscape photography.',
        ]);

        $this->assertDatabaseMissing('resume_interests', [
            'resume_id' => $resume->id,
            'description' => 'This entry should be ignored.',
        ]);
    }

    public function test_interest_can_be_created_without_description(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'interests' => [
                    [
                        'interest_name' => 'Reading',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(1, $resume->interests);

        $this->assertDatabaseHas('resume_interests', [
            'resume_id' => $resume->id,
            'interest_name' => 'Reading',
            'description' => null,
        ]);
    }

    public function test_interest_name_longer_than_255_characters_is_rejected(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from(route('user.resumes.create'))
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'interests' => [
                    [
                        'interest_name' => str_repeat('a', 256),
                        'description' => 'Invalid interest.',
                    ],
                ],
            ]);

        $response
            ->assertRedirect(route('user.resumes.create'))
            ->assertSessionHasErrors([
                'interests.0.interest_name',
            ]);

        $this->assertDatabaseMissing('resumes', [
            'user_id' => $user->id,
            'title' => 'Software Developer Resume',
        ]);

        $this->assertDatabaseCount('resume_interests', 0);
    }

    public function test_updating_resume_replaces_existing_interest_records(): void
    {
        $user = User::factory()->create();
        $resume = $this->createResume($user);

        $oldInterest = $resume->interests()->create([
            'interest_name' => 'Old Interest',
            'description' => 'Old description.',
        ]);

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                [
                    ...$this->updatePayload(),
                    'interests' => [
                        [
                            'interest_name' => 'Artificial Intelligence',
                            'description' => 'Machine learning and NLP.',
                        ],
                        [
                            'interest_name' => 'Software Engineering',
                            'description' => 'Building reliable applications.',
                        ],
                    ],
                ]
            );

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume->refresh();

        $this->assertCount(2, $resume->interests);

        $this->assertDatabaseMissing('resume_interests', [
            'id' => $oldInterest->id,
        ]);

        $this->assertDatabaseHas('resume_interests', [
            'resume_id' => $resume->id,
            'interest_name' => 'Artificial Intelligence',
            'description' => 'Machine learning and NLP.',
        ]);

        $this->assertDatabaseHas('resume_interests', [
            'resume_id' => $resume->id,
            'interest_name' => 'Software Engineering',
            'description' => 'Building reliable applications.',
        ]);
    }

    public function test_updating_resume_without_interests_removes_existing_records(): void
    {
        $user = User::factory()->create();
        $resume = $this->createResume($user);

        $interest = $resume->interests()->create([
            'interest_name' => 'Artificial Intelligence',
            'description' => 'Machine learning and NLP.',
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

        $this->assertDatabaseMissing('resume_interests', [
            'id' => $interest->id,
        ]);

        $this->assertCount(
            0,
            $resume->fresh()->interests
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