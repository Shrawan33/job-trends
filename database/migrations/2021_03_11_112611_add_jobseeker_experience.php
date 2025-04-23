<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobseekerExperience extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_experience', function (Blueprint $table) {
            $table->renameColumn('year_range', 'duration_from');
        });

        Schema::table('job_seeker_experience', function (Blueprint $table) {
            $table->integer('duration_from')->nullable()->change();
            $table->integer('duration_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_experience', function (Blueprint $table) {
            $table->dropColumn('duration_to');
        });
    }
}
