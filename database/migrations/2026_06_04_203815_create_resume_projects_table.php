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
        Schema::create('resume_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resume_id')->constrained()->cascadeOnDelete();
            $table->string('project_title');
            $table->text('project_description')->nullable();
            $table->string('project_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_projects');
    }
};

/** 
 * Brief explanation: This table stores the projects related to each résumé. The resume_id field specifies which résumé each project belongs to. If a résumé is deleted, its related projects will also be deleted automatically using cascadeOnDelete().
*/