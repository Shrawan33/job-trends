<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStateJobtypeJobseekerDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_detail', function (Blueprint $table) {
            $table->unsignedInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('SET NULL');

            $table->unsignedInteger('work_type_id')->nullable();
            $table->foreign('work_type_id')->references('id')->on('work_types')->onDelete('SET NULL');

            $table->string('area')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_detail', function (Blueprint $table) {
            $table->dropForeign('job_seeker_detail_state_id_foreign');
            $table->dropColumn('state_id');

            $table->dropForeign('job_seeker_detail_work_type_id_foreign');
            $table->dropColumn('work_type_id');

            $table->dropColumn('area');
        });
    }
}
