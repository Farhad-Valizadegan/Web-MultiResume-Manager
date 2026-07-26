<?php

namespace Tests\Feature\User;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResumeSkillTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_resume_with_multiple_skill_records(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'skills' => [
                    [
                        'skill_category' => 'Backend Development',
                        'skill_name' => 'Laravel',
                        'skill_level' => 'Advanced',
                    ],
                    [
                        'skill_category' => 'Frontend Development',
                        'skill_name' => 'React',
                        'skill_level' => 'Intermediate',
                    ],
                    [
                        'skill_category' => 'Databases',
                        'skill_name' => 'MySQL',
                        'skill_level' => 'Advanced',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(3, $resume->skills);

        $this->assertDatabaseHas('resume_skills', [
            'resume_id' => $resume->id,
            'skill_category' => 'Backend Development',
            'skill_name' => 'Laravel',
            'skill_level' => 'Advanced',
        ]);

        $this->assertDatabaseHas('resume_skills', [
            'resume_id' => $resume->id,
            'skill_category' => 'Frontend Development',
            'skill_name' => 'React',
            'skill_level' => 'Intermediate',
        ]);

        $this->assertDatabaseHas('resume_skills', [
            'resume_id' => $resume->id,
            'skill_category' => 'Databases',
            'skill_name' => 'MySQL',
            'skill_level' => 'Advanced',
        ]);
    }

    public function test_skill_without_name_is_ignored(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'skills' => [
                    [
                        'skill_category' => 'Ignored Category',
                        'skill_name' => '',
                        'skill_level' => 'Advanced',
                    ],
                    [
                        'skill_category' => 'Backend Development',
                        'skill_name' => 'PHP',
                        'skill_level' => 'Advanced',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(1, $resume->skills);

        $this->assertDatabaseHas('resume_skills', [
            'resume_id' => $resume->id,
            'skill_category' => 'Backend Development',
            'skill_name' => 'PHP',
            'skill_level' => 'Advanced',
        ]);

        $this->assertDatabaseMissing('resume_skills', [
            'resume_id' => $resume->id,
            'skill_category' => 'Ignored Category',
        ]);
    }

    public function test_skill_can_be_created_without_category_and_level(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'skills' => [
                    [
                        'skill_name' => 'Docker',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(1, $resume->skills);

        $this->assertDatabaseHas('resume_skills', [
            'resume_id' => $resume->id,
            'skill_category' => null,
            'skill_name' => 'Docker',
            'skill_level' => null,
        ]);
    }

    public function test_skill_fields_longer_than_255_characters_are_rejected(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from(route('user.resumes.create'))
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'skills' => [
                    [
                        'skill_category' => str_repeat('a', 256),
                        'skill_name' => str_repeat('b', 256),
                        'skill_level' => str_repeat('c', 256),
                    ],
                ],
            ]);

        $response
            ->assertRedirect(route('user.resumes.create'))
            ->assertSessionHasErrors([
                'skills.0.skill_category',
                'skills.0.skill_name',
                'skills.0.skill_level',
            ]);

        $this->assertDatabaseMissing('resumes', [
            'user_id' => $user->id,
            'title' => 'Software Developer Resume',
        ]);

        $this->assertDatabaseCount('resume_skills', 0);
    }

    public function test_updating_resume_replaces_existing_skill_records(): void
    {
        $user = User::factory()->create();
        $resume = $this->createResume($user);

        $oldSkill = $resume->skills()->create([
            'skill_category' => 'Old Category',
            'skill_name' => 'Old Skill',
            'skill_level' => 'Beginner',
        ]);

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                [
                    ...$this->updatePayload(),
                    'skills' => [
                        [
                            'skill_category' => 'Backend Development',
                            'skill_name' => 'Laravel',
                            'skill_level' => 'Advanced',
                        ],
                        [
                            'skill_category' => 'DevOps',
                            'skill_name' => 'Docker',
                            'skill_level' => 'Intermediate',
                        ],
                    ],
                ]
            );

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume->refresh();

        $this->assertCount(2, $resume->skills);

        $this->assertDatabaseMissing('resume_skills', [
            'id' => $oldSkill->id,
        ]);

        $this->assertDatabaseHas('resume_skills', [
            'resume_id' => $resume->id,
            'skill_category' => 'Backend Development',
            'skill_name' => 'Laravel',
            'skill_level' => 'Advanced',
        ]);

        $this->assertDatabaseHas('resume_skills', [
            'resume_id' => $resume->id,
            'skill_category' => 'DevOps',
            'skill_name' => 'Docker',
            'skill_level' => 'Intermediate',
        ]);
    }

    public function test_updating_resume_without_skills_removes_existing_records(): void
    {
        $user = User::factory()->create();
        $resume = $this->createResume($user);

        $skill = $resume->skills()->create([
            'skill_category' => 'Backend Development',
            'skill_name' => 'Laravel',
            'skill_level' => 'Advanced',
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

        $this->assertDatabaseMissing('resume_skills', [
            'id' => $skill->id,
        ]);

        $this->assertCount(
            0,
            $resume->fresh()->skills
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