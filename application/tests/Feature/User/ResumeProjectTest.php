<?php

namespace Tests\Feature\User;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResumeProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_resume_with_multiple_project_records(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'projects' => [
                    [
                        'project_title' => 'KanbanFlow',
                        'project_description' =>
                            'A full-stack Kanban project management system.',
                        'project_link' =>
                            'https://github.com/example/kanbanflow',
                    ],
                    [
                        'project_title' =>
                            'Resume Management System',
                        'project_description' =>
                            'A Laravel résumé builder and management platform.',
                        'project_link' =>
                            'https://github.com/example/resume-system',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(2, $resume->projects);

        $this->assertDatabaseHas('resume_projects', [
            'resume_id' => $resume->id,
            'project_title' => 'KanbanFlow',
            'project_description' =>
                'A full-stack Kanban project management system.',
            'project_link' =>
                'https://github.com/example/kanbanflow',
        ]);

        $this->assertDatabaseHas('resume_projects', [
            'resume_id' => $resume->id,
            'project_title' => 'Resume Management System',
            'project_description' =>
                'A Laravel résumé builder and management platform.',
            'project_link' =>
                'https://github.com/example/resume-system',
        ]);
    }

    public function test_project_without_title_is_ignored(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'projects' => [
                    [
                        'project_title' => '',
                        'project_description' =>
                            'This project must not be stored.',
                        'project_link' =>
                            'https://example.com/ignored-project',
                    ],
                    [
                        'project_title' => 'Valid Project',
                        'project_description' =>
                            'This project should be stored.',
                        'project_link' =>
                            'https://example.com/valid-project',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(1, $resume->projects);

        $this->assertDatabaseHas('resume_projects', [
            'resume_id' => $resume->id,
            'project_title' => 'Valid Project',
            'project_description' =>
                'This project should be stored.',
        ]);

        $this->assertDatabaseMissing('resume_projects', [
            'resume_id' => $resume->id,
            'project_description' =>
                'This project must not be stored.',
        ]);
    }

    public function test_project_can_be_created_without_description_and_link(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'projects' => [
                    [
                        'project_title' => 'Project Title Only',
                    ],
                ],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume = Resume::where('user_id', $user->id)
            ->firstOrFail();

        $this->assertCount(1, $resume->projects);

        $this->assertDatabaseHas('resume_projects', [
            'resume_id' => $resume->id,
            'project_title' => 'Project Title Only',
            'project_description' => null,
            'project_link' => null,
        ]);
    }

    public function test_invalid_project_link_is_rejected(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from(route('user.resumes.create'))
            ->post(route('user.resumes.store'), [
                ...$this->storePayload(),
                'projects' => [
                    [
                        'project_title' => 'Invalid Link Project',
                        'project_description' =>
                            'This project has an invalid link.',
                        'project_link' => 'not-a-valid-url',
                    ],
                ],
            ]);

        $response
            ->assertRedirect(route('user.resumes.create'))
            ->assertSessionHasErrors([
                'projects.0.project_link',
            ]);

        $this->assertDatabaseMissing('resumes', [
            'user_id' => $user->id,
            'title' => 'Software Developer Resume',
        ]);

        $this->assertDatabaseCount('resume_projects', 0);
    }

    public function test_updating_resume_replaces_existing_project_records(): void
    {
        $user = User::factory()->create();
        $resume = $this->createResume($user);

        $oldProject = $resume->projects()->create([
            'project_title' => 'Old Project',
            'project_description' => 'Old project description.',
            'project_link' => 'https://example.com/old-project',
        ]);

        $response = $this
            ->actingAs($user)
            ->put(
                route('user.resumes.update', $resume),
                [
                    ...$this->updatePayload(),
                    'projects' => [
                        [
                            'project_title' => 'KanbanFlow',
                            'project_description' =>
                                'A Laravel and React Kanban system.',
                            'project_link' =>
                                'https://example.com/kanbanflow',
                        ],
                        [
                            'project_title' =>
                                'Git Hosting Platform',
                            'project_description' =>
                                'A self-hosted source code platform.',
                            'project_link' =>
                                'https://example.com/git-hosting',
                        ],
                    ],
                ]
            );

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user.resumes.index'));

        $resume->refresh();

        $this->assertCount(2, $resume->projects);

        $this->assertDatabaseMissing('resume_projects', [
            'id' => $oldProject->id,
        ]);

        $this->assertDatabaseHas('resume_projects', [
            'resume_id' => $resume->id,
            'project_title' => 'KanbanFlow',
            'project_description' =>
                'A Laravel and React Kanban system.',
            'project_link' =>
                'https://example.com/kanbanflow',
        ]);

        $this->assertDatabaseHas('resume_projects', [
            'resume_id' => $resume->id,
            'project_title' => 'Git Hosting Platform',
            'project_description' =>
                'A self-hosted source code platform.',
            'project_link' =>
                'https://example.com/git-hosting',
        ]);
    }

    public function test_updating_resume_without_projects_removes_existing_records(): void
    {
        $user = User::factory()->create();
        $resume = $this->createResume($user);

        $project = $resume->projects()->create([
            'project_title' => 'Project to Remove',
            'project_description' =>
                'This project should be removed.',
            'project_link' =>
                'https://example.com/project-to-remove',
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

        $this->assertDatabaseMissing('resume_projects', [
            'id' => $project->id,
        ]);

        $this->assertCount(
            0,
            $resume->fresh()->projects
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