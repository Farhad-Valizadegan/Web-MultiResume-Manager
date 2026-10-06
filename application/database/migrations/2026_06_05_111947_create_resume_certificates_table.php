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
        Schema::create('resume_certificates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('resume_id')
                ->constrained('resumes')
                ->onDelete('cascade');

            $table->string('certificate_title');
            $table->string('issuer')->nullable();
            $table->date('issue_date')->nullable();
            $table->string('credential_id')->nullable();
            $table->string('credential_url')->nullable();

            $table->text('description')->nullable();

            $table->string('related_project_title')->nullable();
            $table->string('related_project_link')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_certificates');
    }
};