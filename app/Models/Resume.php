<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'job_position',
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