<?php

namespace Tests\Feature\User;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectLinkLabelTest extends TestCase
{
    use RefreshDatabase;

    private function payload(?string $label, ?string $url = 'https://example.com/demo'): array
    {
        return ['title' => 'Project resume', 'download_resume_type' => 'generated',
            'skill_display_style' => 'compact', 'theme' => 'professional_blue',
            'projects' => [['project_title' => 'Demo project', 'project_link' => $url, 'project_link_label' => $label]]];
    }

    public function test_project_link_text_is_saved_updated_escaped_and_optional(): void
    {
        $user = User::factory()->create(['role' => 'user', 'status' => 'active']);
        $this->actingAs($user)->post(route('user.resumes.store'), $this->payload('<b>Watch demo</b>'))->assertSessionHasNoErrors();
        $resume = Resume::where('user_id', $user->id)->firstOrFail();
        $this->assertSame('<b>Watch demo</b>', $resume->projects()->first()->project_link_label);
        foreach (['public.resume-view', 'public.resume-pdf'] as $view) {
            $html = view($view, ['resume' => $resume->fresh()])->render();
            $this->assertStringContainsString('&lt;b&gt;Watch demo&lt;/b&gt;', $html);
            $this->assertStringNotContainsString('<b>Watch demo</b>', $html);
            $this->assertStringContainsString('href="https://example.com/demo"', $html);
        }
        $this->actingAs($user)->put(route('user.resumes.update', $resume), $this->payload('Source code', 'https://example.com/code') + ['status' => 'active'])->assertSessionHasNoErrors();
        $this->assertSame('Source code', $resume->projects()->first()->project_link_label);
        $this->assertSame('https://example.com/code', $resume->projects()->first()->project_link);
        $this->actingAs($user)->put(route('user.resumes.update', $resume), $this->payload(null) + ['status' => 'active'])->assertSessionHasNoErrors();
        $this->assertNull($resume->projects()->first()->project_link_label);
        $this->assertStringContainsString('View Project', view('public.resume-view', ['resume' => $resume->fresh()])->render());
    }

    public function test_invalid_project_urls_and_overlong_labels_are_rejected(): void
    {
        $user = User::factory()->create(['role' => 'user', 'status' => 'active']);
        $this->actingAs($user)->post(route('user.resumes.store'), $this->payload(null))->assertSessionHasNoErrors();
        $resume = Resume::where('user_id', $user->id)->firstOrFail();
        foreach (['javascript:alert(1)', 'ftp://example.com/file', 'not-a-url'] as $url) {
            $this->actingAs($user)->post(route('user.resumes.store'), $this->payload('Watch demo', $url))->assertSessionHasErrors('projects.0.project_link');
            $this->actingAs($user)->put(route('user.resumes.update', $resume), $this->payload('Watch demo', $url) + ['status' => 'active'])->assertSessionHasErrors('projects.0.project_link');
        }
        $this->actingAs($user)->post(route('user.resumes.store'), $this->payload(str_repeat('a', 101)))->assertSessionHasErrors('projects.0.project_link_label');
        $this->actingAs($user)->put(route('user.resumes.update', $resume), $this->payload(str_repeat('a', 101)) + ['status' => 'active'])->assertSessionHasErrors('projects.0.project_link_label');
    }
}
