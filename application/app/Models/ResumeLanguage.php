<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeLanguage extends Model
{
    protected $fillable = [
        'resume_id',
        'language_name',
        'proficiency_level',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}