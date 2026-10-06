<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resume_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resume_id')->constrained()->cascadeOnDelete();
            $table->string('institution_name');
            $table->string('degree')->nullable();
            $table->string('field_of_study')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_educations');
    }
};


/*
This migration is used to create the resume_educations table. This table stores the educational information related to each résumé.
Since each user can have multiple résumés, and each résumé can have multiple educational records, this table is connected to the resumes table through the resume_id field.
Its main fields include the institution or university name, degree, field of study, start date, and end date.
The cascadeOnDelete() option means that if a résumé is deleted, all educational records related to that résumé will also be deleted automatically.
*/