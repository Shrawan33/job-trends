<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobTypeIdToEmployerJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employer_jobs', function (Blueprint $table) {
            $table->unsignedInteger('job_type_id')->nullable();
            $table->foreign('job_type_id')->references('id')->on('job_types')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employer_jobs', function (Blueprint $table) {
            $table->dropForeign(['job_type_id']);
        });
    }
}
