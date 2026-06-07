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
        Schema::table('resumes', function (Blueprint $table) {
            $table->string('uploaded_resume_file')->nullable()->after('resume_password_hash');

            $table->enum('download_resume_type', [
                'generated',
                'uploaded',
                'both',
            ])->default('generated')->after('uploaded_resume_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->dropColumn([
                'uploaded_resume_file',
                'download_resume_type',
            ]);
        });
    }
};