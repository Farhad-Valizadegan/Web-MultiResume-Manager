<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeCertificate extends Model
{
    protected $fillable = [
        'resume_id',
        'certificate_title',
        'issuer',
        'issue_date',
        'credential_id',
        'credential_url',
        'certificate_file',
        'description',
        'related_project_title',
        'related_project_link',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}