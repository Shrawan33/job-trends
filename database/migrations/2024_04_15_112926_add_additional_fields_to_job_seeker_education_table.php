<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToJobSeekerEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_education', function (Blueprint $table) {
            $table->integer('education_duration_from')->nullable();
            $table->integer('education_duration_to')->nullable();
            $table->string('education_from_month')->nullable();
            $table->string('education_to_month')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_education', function (Blueprint $table) {
            $table->dropColumn('education_duration_from');
            $table->dropColumn('education_duration_to');
            $table->dropColumn('education_from_month');
            $table->dropColumn('education_to_month');
        });
    }
}
