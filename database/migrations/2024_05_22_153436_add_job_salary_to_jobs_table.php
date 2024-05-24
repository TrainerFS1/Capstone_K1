<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobSalaryToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('job_salary')->nullable(); // Menambahkan kolom job_salary dengan tipe data string
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('job_salary'); // Menghapus kolom job_salary jika migrasi dibatalkan
        });
    }
}
