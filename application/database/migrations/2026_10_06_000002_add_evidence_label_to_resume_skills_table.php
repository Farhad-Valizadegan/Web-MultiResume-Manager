<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('resume_skills', function (Blueprint $table) {
            $table->string('evidence_label', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('resume_skills', function (Blueprint $table) {
            $table->dropColumn('evidence_label');
        });
    }
};
