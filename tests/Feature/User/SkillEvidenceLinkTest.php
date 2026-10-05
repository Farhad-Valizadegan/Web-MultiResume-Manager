<?php

namespace Tests\Feature\User;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SkillEvidenceLinkTest extends TestCase
{
    use RefreshDatabase;

    private function payload(?string $url): array
    {
        return [
            'title' => 'Evidence resume',
            'download_resume_type' => 'generated',
            'skill_display_style' => 'compact',
            'theme' => 'professional_blue',
            'skills' => [['skill_name' => 'Laravel', 'evidence_url' => $url]],
        ];
    }

    public function test_links_can_be_saved_updated_and_removed(): void
    {
        $user = User::factory()->create(['role' => 'user', 'status' => 'active']);
        $this->actingAs($user)->post(route('user.resumes.store'), $this->payload('https://example.com/demo?x=1&y=2'))
            ->assertSessionHasNoErrors();
        $resume = Resume::where('user_id', $user->id)->firstOrFail();
        $this->assertSame('https://example.com/demo?x=1&y=2', $resume->skills()->first()->evidence_url);
        $this->actingAs($user)->put(route('user.resumes.update', $resume), $this->payload('https://example.com/video') + ['status' => 'active'])
            ->assertSessionHasNoErrors();
        $this->assertSame('https://example.com/video', $resume->skills()->first()->evidence_url);
        $this->actingAs($user)->put(route('user.resumes.update', $resume), $this->payload(null) + ['status' => 'active'])
            ->assertSessionHasNoErrors();
        $this->assertNull($resume->skills()->first()->evidence_url);
    }

    public function test_unsafe_or_malformed_links_are_rejected_on_create_and_update(): void
    {
        $user = User::factory()->create(['role' => 'user', 'status' => 'active']);
        $this->actingAs($user)->post(route('user.resumes.store'), $this->payload(null))->assertSessionHasNoErrors();
        $resume = Resume::where('user_id', $user->id)->firstOrFail();
        foreach (['javascript:alert(1)', 'data:text/html,bad', 'ftp://example.com/file', 'not-a-url', 'https://example.com/'.str_repeat('a', 2048)] as $url) {
            $this->actingAs($user)->post(route('user.resumes.store'), $this->payload($url))->assertSessionHasErrors('skills.0.evidence_url');
            $this->actingAs($user)->put(route('user.resumes.update', $resume), $this->payload($url) + ['status' => 'active'])
                ->assertSessionHasErrors('skills.0.evidence_url');
        }
        $this->assertNull($resume->skills()->first()->evidence_url);
    }

    public function test_custom_link_text_is_saved_escaped_and_optional(): void
    {
        $user = User::factory()->create(['role' => 'user', 'status' => 'active']);
        $payload = $this->payload('https://example.com/video');
        $payload['skills'][0]['evidence_label'] = '<script>Watch my demo</script>';
        $this->actingAs($user)->post(route('user.resumes.store'), $payload)->assertSessionHasNoErrors();
        $resume = Resume::where('user_id', $user->id)->firstOrFail();
        $this->assertSame('<script>Watch my demo</script>', $resume->skills()->first()->evidence_label);
        foreach (['compact', 'cards'] as $style) {
            $resume->update(['skill_display_style' => $style]);
            $html = view('public.resume-view', ['resume' => $resume->fresh()])->render();
            $this->assertStringContainsString('&lt;script&gt;Watch my demo&lt;/script&gt;', $html);
            $this->assertStringNotContainsString('<script>Watch my demo</script>', $html);
        }
        $html = view('public.resume-pdf', ['resume' => $resume->fresh()])->render();
        $this->assertStringContainsString('&lt;script&gt;Watch my demo&lt;/script&gt;', $html);
        $payload['skills'][0]['evidence_label'] = str_repeat('a', 101);
        $this->actingAs($user)->put(route('user.resumes.update', $resume), $payload + ['status' => 'active'])
            ->assertSessionHasErrors('skills.0.evidence_label');
        $payload['skills'][0]['evidence_label'] = 'Watch my demo';
        $this->actingAs($user)->put(route('user.resumes.update', $resume), $payload + ['status' => 'active'])
            ->assertSessionHasNoErrors();
        $this->assertSame('Watch my demo', $resume->skills()->first()->evidence_label);
        $payload['skills'][0]['evidence_label'] = null;
        $this->actingAs($user)->put(route('user.resumes.update', $resume), $payload + ['status' => 'active'])
            ->assertSessionHasNoErrors();
        $this->assertNull($resume->skills()->first()->evidence_label);
    }

    public function test_links_are_rendered_in_both_skill_styles_and_pdf_template(): void
    {
        $user = User::factory()->create(['role' => 'user', 'status' => 'active']);
        $this->actingAs($user)->post(route('user.resumes.store'), $this->payload('https://example.com/demo?x=1&y=2'))->assertSessionHasNoErrors();
        $resume = Resume::where('user_id', $user->id)->firstOrFail();
        foreach (['compact', 'cards'] as $style) {
            $resume->update(['skill_display_style' => $style]);
            $html = view('public.resume-view', ['resume' => $resume->fresh()])->render();
            $this->assertStringContainsString('https://example.com/demo?x=1&amp;y=2', $html);
            $this->assertStringContainsString('View evidence', $html);
            $this->assertStringContainsString('rel="noopener noreferrer"', $html);
        }
        $html = view('public.resume-pdf', ['resume' => $resume->fresh()])->render();
        $this->assertStringContainsString('https://example.com/demo?x=1&amp;y=2', $html);
        $this->assertStringContainsString('View evidence', $html);
    }
}
