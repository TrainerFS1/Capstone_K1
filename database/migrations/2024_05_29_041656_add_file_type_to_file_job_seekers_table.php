<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileTypeToFileJobSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('file_job_seekers', function (Blueprint $table) {
            $table->enum('file_type', ['primary', 'secondary'])->default('primary')->after('job_seeker_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('file_job_seekers', function (Blueprint $table) {
            $table->dropColumn('file_type');
        });
    }
}
