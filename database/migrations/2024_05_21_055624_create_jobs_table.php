<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('job_title');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->text('job_description')->nullable();
            $table->string('job_location')->nullable();
            $table->text('job_skills')->nullable();
            $table->foreignId('job_type_id')->constrained('job_types')->onDelete('cascade');
            $table->enum('job_status', ['active', 'inactive']);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
