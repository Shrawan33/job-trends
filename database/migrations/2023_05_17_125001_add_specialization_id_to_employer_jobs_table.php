<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSpecializationIdToEmployerJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employer_jobs', function (Blueprint $table) {
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
        Schema::table('employer_jobs', function (Blueprint $table) {
            $table->dropForeign(['specialization_id']);
        });
    }
}
