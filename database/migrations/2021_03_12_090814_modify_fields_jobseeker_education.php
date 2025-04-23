<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFieldsJobseekerEducation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_education', function (Blueprint $table) {
            $table->boolean('entitled')->nullable()->change();
            $table->renameColumn('year', 'duration_from');
        });
        Schema::table('job_seeker_education', function (Blueprint $table) {
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
