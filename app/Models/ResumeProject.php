<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeProject extends Model
{
    protected $fillable = [
        'resume_id',
        'project_title',
        'project_description',
        'project_link',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}