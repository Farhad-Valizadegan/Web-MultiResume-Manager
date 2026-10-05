<?php

namespace Tests\Feature\User;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResumeDateEditorTest extends TestCase
{
    use RefreshDatabase;

    private function payload(?string $start, ?string $end): array
    {
        return ['title' => 'Dated resume', 'download_resume_type' => 'generated', 'skill_display_style' => 'compact',
            'theme' => 'professional_blue', 'experiences' => [['company_name' => 'Example company', 'start_date' => $start, 'end_date' => $end]]];
    }

    public function test_month_inputs_can_be_saved_and_updated_and_ongoing_work_is_supported(): void
    {
        $user = User::factory()->create(['role' => 'user', 'status' => 'active']);
        $this->actingAs($user)->post(route('user.resumes.store'), $this->payload('2023-02', '2023-02'))->assertSessionHasNoErrors();
        $resume = Resume::where('user_id', $user->id)->firstOrFail();
        $this->assertSame('2023-02-01', $resume->experiences()->first()->start_date);
        $this->actingAs($user)->put(route('user.resumes.update', $resume), $this->payload('2023-02', null) + ['status' => 'active'])->assertSessionHasNoErrors();
        $this->assertNull($resume->experiences()->first()->end_date);
        $this->actingAs($user)->get(route('user.resumes.edit', $resume))->assertOk()->assertSee('type="month"', false)->assertSee('value="2023-02"', false);
    }

    public function test_future_employment_and_reversed_month_ranges_are_rejected(): void
    {
        $user = User::factory()->create(['role' => 'user', 'status' => 'active']);
        $this->actingAs($user)->post(route('user.resumes.store'), $this->payload('2023-02', null))->assertSessionHasNoErrors();
        $resume = Resume::where('user_id', $user->id)->firstOrFail();
        foreach ([['2023-03', '2023-02', 'end_date'], ['2222-02', null, 'start_date'], ['2023-02', '2222-02', 'end_date'], ['2023-13', null, 'start_date']] as [$start, $end, $field]) {
            $this->actingAs($user)->post(route('user.resumes.store'), $this->payload($start, $end))->assertSessionHasErrors('experiences.0.'.$field);
            $this->actingAs($user)->put(route('user.resumes.update', $resume), $this->payload($start, $end) + ['status' => 'active'])->assertSessionHasErrors('experiences.0.'.$field);
        }
        $this->assertSame('2023-02-01', $resume->experiences()->first()->start_date);
    }

    public function test_education_accepts_expected_end_month_but_rejects_reversed_ranges(): void
    {
        $user = User::factory()->create(['role' => 'user', 'status' => 'active']);
        $payload = $this->payload(null, null);
        $payload['educations'] = [['institution_name' => 'Example university', 'start_date' => '2023-02', 'end_date' => '2030-06']];
        $this->actingAs($user)->post(route('user.resumes.store'), $payload)->assertSessionHasNoErrors();
        $resume = Resume::where('user_id', $user->id)->firstOrFail();
        $this->assertSame('2030-06-01', $resume->educations()->first()->end_date);
        $payload['educations'][0]['end_date'] = '2022-01';
        $this->actingAs($user)->put(route('user.resumes.update', $resume), $payload + ['status' => 'active'])->assertSessionHasErrors('educations.0.end_date');
    }
}
