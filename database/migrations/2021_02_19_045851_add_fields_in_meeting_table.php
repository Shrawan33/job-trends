<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInMeetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zoom_meeting', function (Blueprint $table) {
            $table->unsignedBigInteger('jobseeker_id')->nullable();
            $table->unsignedInteger('employer_job_id')->nullable();
            $table->string('start_url')->nullable();
            $table->string('join_url')->nullable();
            $table->string('password')->nullable();
            $table->string('host_id')->nullable();
            $table->string('main_id')->nullable();
            $table->json('meeting_json')->nullable();
            $table->foreign('jobseeker_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('employer_job_id')->references('id')->on('employer_jobs')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zoom_meeting', function (Blueprint $table) {
            $table->dropForeign('zoom_meeting_jobseeker_id_foreign');
            $table->dropColumn('jobseeker_id');
            $table->dropForeign('zoom_meeting_employer_job_id_foreign');
            $table->dropColumn('employer_job_id');
            $table->dropColumn('start_url');
            $table->dropColumn('join_url');
            $table->dropColumn('password');
            $table->dropColumn('host_id');
            $table->dropColumn('main_id');
            $table->dropColumn('meeting_json');
        });
    }
}
