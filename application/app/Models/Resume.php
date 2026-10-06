<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'job_position',
        'full_name',
        'email',
        'phone',
        'address',
        'postal_code',
        'city',
        'country',
        'website',
        'linkedin',
        'github',
        'profile_photo',
        'professional_summary',
        'public_link',
        'resume_password_hash',
        'uploaded_resume_file',
        'download_resume_type',
        'skill_display_style',
        'theme',
        'view_count',
        'last_viewed_at',
        'status',
    ];

    protected $casts = [
        'last_viewed_at' => 'datetime',
    ];

    public function publicAccessToken(): string
    {
        return hash_hmac('sha256', (string) $this->resume_password_hash, (string) config('app.key'));
    }

    public function allowsPublicAccess(\Illuminate\Http\Request $request): bool
    {
        if (!$this->resume_password_hash) {
            return true;
        }
        $grant = $request->session()->get('public_resume_access_' . $this->id);
        return is_string($grant) && hash_equals($this->publicAccessToken(), $grant);
    }

    protected static function booted(): void
    {
        static::deleting(function (Resume $resume) {
            $files = app(\App\Services\ResumeFiles::class);
            $files->delete($resume->uploaded_resume_file);
            $files->delete($resume->profile_photo);
            foreach ($resume->certificates as $certificate) {
                $files->delete($certificate->certificate_file);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skills()
    {
        return $this->hasMany(ResumeSkill::class);
    }

    public function languages()
    {
        return $this->hasMany(ResumeLanguage::class);
    }

    public function experiences()
    {
        return $this->hasMany(ResumeExperience::class);
    }

    public function educations()
    {
        return $this->hasMany(ResumeEducation::class);
    }

    public function projects()
    {
        return $this->hasMany(ResumeProject::class);
    }

    public function certificates()
    {
        return $this->hasMany(ResumeCertificate::class);
    }

    public function interests()
    {
        return $this->hasMany(ResumeInterest::class);
    }
}