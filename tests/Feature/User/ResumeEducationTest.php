<?php

namespace Tests\Feature\User;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResumeEducationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_resume_with_multiple_education_records(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'educations' => [
                    [
                        'institution_name' =>
                            'Islamic Azad University',
                        'degree' => 'Bachelor of Engineering',
                        'field_of_study' =>
                            'Computer Software Engineering',
                        'start_date' => '2011-09-01',
                        'end_date' => '2014-06-30',
                        'description' =>
                            'Studied software engineering.',
                    ],
                    [
                        'institution_name' =>
                            'Technical College',
                        'degree' => 'Associate Degree',
                        'field_of_study' => 'Computer Science',
                        'start_date' => '2007-09-01',
                        'end_date' => '2010-06-30',
                        'description' =>
                            'Studied computer science.',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(2, $resume->educations);

        $this->assertDatabaseHas('resume_educations', [
            'resume_id' => $resume->id,
            'institution_name' => 'Islamic Azad University',
            'degree' => 'Bachelor of Engineering',
            'field_of_study' =>
                'Computer Software Engineering',
            'start_date' => '2011-09-01',
            'end_date' => '2014-06-30',
            'description' => 'Studied software engineering.',
        ]);

        $this->assertDatabaseHas('resume_educations', [
            'resume_id' => $resume->id,
            'institution_name' => 'Technical College',
            'degree' => 'Associate Degree',
            'field_of_study' => 'Computer Science',
            'start_date' => '2007-09-01',
            'end_date' => '2010-06-30',
            'description' => 'Studied computer science.',
        ]);
    }

    public function test_education_without_institution_name_is_ignored(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'educations' => [
                    [
                        'institution_name' => '',
                        'degree' => 'Bachelor of Engineering',
                        'field_of_study' =>
                            'Computer Software Engineering',
                        'start_date' => '2011-09-01',
                        'end_date' => '2014-06-30',
                        'description' =>
                            'This entry must not be stored.',
                    ],
                    [
                        'institution_name' => 'FAU Erlangen',
                        'degree' => 'Master of Science',
                        'field_of_study' =>
                            'Computational Engineering',
                        'start_date' => '2023-10-01',
                        'end_date' => null,
                        'description' => null,
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(1, $resume->educations);

        $this->assertDatabaseHas('resume_educations', [
            'resume_id' => $resume->id,
            'institution_name' => 'FAU Erlangen',
            'degree' => 'Master of Science',
        ]);

        $this->assertDatabaseMissing('resume_educations', [
            'resume_id' => $resume->id,
            'degree' => 'Bachelor of Engineering',
        ]);
    }

    public function test_updating_resume_replaces_existing_education_records(): void
    {
        $user = User::factory()->create();
        $resume = $this->createResume($user);

        $oldEducation = $resume->educations()->create([
            'institution_name' => 'Old University',
            'degree' => 'Old Degree',
            'field_of_study' => 'Old Field',
            'start_date' => '2005-09-01',
            'end_date' => '2009-06-30',
            'description' => 'Old education record.',
        ]);

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                [
                    ...$this->updatePayload(),
                    'educations' => [
                        [
                            'institution_name' =>
                                'Islamic Azad University',
                            'degree' => 'Bachelor of Engineering',
                            'field_of_study' =>
                                'Computer Software Engineering',
                            'start_date' => '2011-09-01',
                            'end_date' => '2014-06-30',
                            'description' =>
                                'Studied software engineering.',
                        ],
                        [
                            'institution_name' => 'FAU Erlangen',
                            'degree' => 'Master of Science',
                            'field_of_study' =>
                                'Computational Engineering',
                            'start_date' => '2023-10-01',
                            'end_date' => null,
                            'description' => null,
                        ],
                    ],
                ]
            );

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume->refresh();

        $this->assertCount(2, $resume->educations);

        $this->assertDatabaseMissing('resume_educations', [
            'id' => $oldEducation->id,
        ]);

        $this->assertDatabaseHas('resume_educations', [
            'resume_id' => $resume->id,
            'institution_name' => 'Islamic Azad University',
            'degree' => 'Bachelor of Engineering',
        ]);

        $this->assertDatabaseHas('resume_educations', [
            'resume_id' => $resume->id,
            'institution_name' => 'FAU Erlangen',
            'degree' => 'Master of Science',
        ]);
    }

    public function test_updating_resume_without_education_removes_existing_records(): void
    {
        $user = User::factory()->create();
        $resume = $this->createResume($user);

        $education = $resume->educations()->create([
            'institution_name' => 'University to Remove',
            'degree' => 'Bachelor of Science',
            'field_of_study' => 'Computer Science',
            'start_date' => '2010-09-01',
            'end_date' => '2014-06-30',
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

        $this->assertDatabaseMissing('resume_educations', [
            'id' => $education->id,
        ]);

        $this->assertCount(
            0,
            $resume->fresh()->educations
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