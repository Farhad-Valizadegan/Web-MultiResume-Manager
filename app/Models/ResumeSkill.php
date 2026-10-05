<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeSkill extends Model
{
    protected $fillable = [
        'resume_id',
        'skill_category',
        'skill_name',
        'skill_level',
        'evidence_url',
        'evidence_label',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}