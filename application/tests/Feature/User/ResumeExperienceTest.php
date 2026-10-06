<?php

namespace Tests\Feature\User;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResumeExperienceTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_resume_with_multiple_experience_records(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'experiences' => [
                    [
                        'company_name' => 'Zar Vision Rasta Co.',
                        'job_title' => 'Data Analyst and Web Developer',
                        'start_date' => '2020-01-01',
                        'end_date' => '2023-12-31',
                        'description' =>
                            'Developed web applications and analyzed data.',
                    ],
                    [
                        'company_name' => 'Example Technology GmbH',
                        'job_title' => 'Full-Stack Developer',
                        'start_date' => '2024-01-01',
                        'end_date' => null,
                        'description' =>
                            'Developed Laravel and React applications.',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(2, $resume->experiences);

        $this->assertDatabaseHas('resume_experiences', [
            'resume_id' => $resume->id,
            'company_name' => 'Zar Vision Rasta Co.',
            'job_title' => 'Data Analyst and Web Developer',
            'start_date' => '2020-01-01',
            'end_date' => '2023-12-31',
            'description' =>
                'Developed web applications and analyzed data.',
        ]);

        $this->assertDatabaseHas('resume_experiences', [
            'resume_id' => $resume->id,
            'company_name' => 'Example Technology GmbH',
            'job_title' => 'Full-Stack Developer',
            'start_date' => '2024-01-01',
            'end_date' => null,
            'description' =>
                'Developed Laravel and React applications.',
        ]);
    }

    public function test_experience_without_company_and_job_title_is_ignored(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'experiences' => [
                    [
                        'company_name' => '',
                        'job_title' => '',
                        'start_date' => '2015-01-01',
                        'end_date' => '2016-01-01',
                        'description' =>
                            'This entry must not be stored.',
                    ],
                    [
                        'company_name' => 'Valid Company',
                        'job_title' => 'Software Developer',
                        'start_date' => '2020-01-01',
                        'end_date' => null,
                        'description' => 'A valid experience record.',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(1, $resume->experiences);

        $this->assertDatabaseHas('resume_experiences', [
            'resume_id' => $resume->id,
            'company_name' => 'Valid Company',
            'job_title' => 'Software Developer',
        ]);

        $this->assertDatabaseMissing('resume_experiences', [
            'resume_id' => $resume->id,
            'description' => 'This entry must not be stored.',
        ]);
    }

    public function test_experience_can_be_created_with_only_company_name(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'experiences' => [
                    [
                        'company_name' => 'Company Only GmbH',
                        'start_date' => '2022-01-01',
                        'end_date' => null,
                        'description' =>
                            'The job title was not provided.',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(1, $resume->experiences);

        $this->assertDatabaseHas('resume_experiences', [
            'resume_id' => $resume->id,
            'company_name' => 'Company Only GmbH',
            'job_title' => 'Not specified',
            'start_date' => '2022-01-01',
            'end_date' => null,
        ]);
    }

    public function test_experience_can_be_created_with_only_job_title(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'experiences' => [
                    [
                        'job_title' => 'Freelance Web Developer',
                        'start_date' => '2021-01-01',
                        'end_date' => null,
                        'description' =>
                            'The company name was not provided.',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(1, $resume->experiences);

        $this->assertDatabaseHas('resume_experiences', [
            'resume_id' => $resume->id,
            'company_name' => 'Not specified',
            'job_title' => 'Freelance Web Developer',
            'start_date' => '2021-01-01',
            'end_date' => null,
        ]);
    }

    public function test_updating_resume_replaces_existing_experience_records(): void
    {
        $user = User::factory()->create();
        $resume = $this->createResume($user);

        $oldExperience = $resume->experiences()->create([
            'company_name' => 'Old Company',
            'job_title' => 'Old Job Title',
            'start_date' => '2015-01-01',
            'end_date' => '2017-12-31',
            'description' => 'Old experience record.',
        ]);

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                [
                    ...$this->updatePayload(),
                    'experiences' => [
                        [
                            'company_name' => 'New Company GmbH',
                            'job_title' => 'Backend Developer',
                            'start_date' => '2020-01-01',
                            'end_date' => '2022-12-31',
                            'description' =>
                                'Developed Laravel applications.',
                        ],
                        [
                            'company_name' => 'Current Company GmbH',
                            'job_title' => 'Full-Stack Developer',
                            'start_date' => '2023-01-01',
                            'end_date' => null,
                            'description' =>
                                'Developing Laravel and React systems.',
                        ],
                    ],
                ]
            );

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume->refresh();

        $this->assertCount(2, $resume->experiences);

        $this->assertDatabaseMissing('resume_experiences', [
            'id' => $oldExperience->id,
        ]);

        $this->assertDatabaseHas('resume_experiences', [
            'resume_id' => $resume->id,
            'company_name' => 'New Company GmbH',
            'job_title' => 'Backend Developer',
        ]);

        $this->assertDatabaseHas('resume_experiences', [
            'resume_id' => $resume->id,
            'company_name' => 'Current Company GmbH',
            'job_title' => 'Full-Stack Developer',
        ]);
    }

    public function test_updating_resume_without_experience_removes_existing_records(): void
    {
        $user = User::factory()->create();
        $resume = $this->createResume($user);

        $experience = $resume->experiences()->create([
            'company_name' => 'Company to Remove',
            'job_title' => 'Software Developer',
            'start_date' => '2018-01-01',
            'end_date' => '2020-12-31',
            'description' => 'This record should be removed.',
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

        $this->assertDatabaseMissing('resume_experiences', [
            'id' => $experience->id,
        ]);

        $this->assertCount(
            0,
            $resume->fresh()->experiences
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