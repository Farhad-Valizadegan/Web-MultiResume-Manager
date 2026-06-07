<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeEducation extends Model
{
    protected $table = 'resume_educations';

    protected $fillable = [
        'resume_id',
        'institution_name',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'description',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}