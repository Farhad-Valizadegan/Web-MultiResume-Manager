<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeInterest extends Model
{
    protected $fillable = [
        'resume_id',
        'interest_name',
        'description',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}