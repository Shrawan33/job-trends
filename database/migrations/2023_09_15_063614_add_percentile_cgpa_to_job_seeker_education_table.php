<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPercentileCgpaToJobSeekerEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_education', function (Blueprint $table) {
            $table->double('percentile_cgpa')->nullable();
            $table->unsignedInteger('specialization_id')->nullable();
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('SET NULL');

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
            $table->dropColumn('percentile_cgpa');
            $table->dropForeign(['specialization_id']); // Drop the foreign key constraint
            $table->dropColumn('specialization_id'); // Drop the column itself
        });
    }
}
