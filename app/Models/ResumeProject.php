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
        'project_link_label',
        'demo_label',
        'demo_url',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}