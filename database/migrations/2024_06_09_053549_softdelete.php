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
        Schema::table('apply_jobs', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('file_job_seekers', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('job_seekers', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('saved_jobs', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apply_jobs', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('file_job_seekers', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('job_seekers', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('saved_jobs', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
};
