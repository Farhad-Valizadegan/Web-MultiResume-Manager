<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add personal information stored independently for each resume.
     */
    public function up(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('job_position');
            $table->string('email')->nullable()->after('full_name');
            $table->string('phone', 50)->nullable()->after('email');

            $table->text('address')->nullable()->after('phone');
            $table->string('postal_code', 30)->nullable()->after('address');
            $table->string('city')->nullable()->after('postal_code');
            $table->string('country')->nullable()->after('city');

            $table->string('website', 2048)->nullable()->after('country');
            $table->string('linkedin', 2048)->nullable()->after('website');
            $table->string('github', 2048)->nullable()->after('linkedin');

            $table->string('profile_photo')->nullable()->after('github');
            $table->text('professional_summary')->nullable()->after('profile_photo');
        });
    }

    /**
     * Remove the resume-specific personal information.
     */
    public function down(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->dropColumn([
                'full_name',
                'email',
                'phone',
                'address',
                'postal_code',
                'city',
                'country',
                'website',
                'linkedin',
                'github',
                'profile_photo',
                'professional_summary',
            ]);
        });
    }
};