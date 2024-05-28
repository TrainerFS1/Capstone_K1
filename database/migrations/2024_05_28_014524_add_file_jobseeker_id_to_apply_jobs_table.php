<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileJobseekerIdToApplyJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apply_jobs', function (Blueprint $table) {
            // Drop the existing category_name column
            $table->dropColumn('category_name');
            
            // Drop the existing file_jobseeker_id column if exists
            if (Schema::hasColumn('apply_jobs', 'file_jobseeker_id')) {
                $table->dropColumn('file_jobseeker_id');
            }
            
            // Add the new column file_jobseeker_id
            $table->foreignId('file_jobseeker_id')->nullable()->constrained('file_job_seekers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apply_jobs', function (Blueprint $table) {
            // Reverse the changes in the up method
            $table->string('category_name');
            $table->dropForeign(['file_jobseeker_id']);
            $table->dropColumn('file_jobseeker_id');
        });
    }
}
