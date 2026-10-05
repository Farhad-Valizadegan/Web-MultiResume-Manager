<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('resume_projects', function (Blueprint $table) {
            $table->string('demo_label', 100)->nullable();
            $table->string('demo_url', 2048)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('resume_projects', function (Blueprint $table) {
            $table->dropColumn(['demo_label', 'demo_url']);
        });
    }
};
