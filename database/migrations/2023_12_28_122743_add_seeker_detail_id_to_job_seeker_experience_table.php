<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeekerDetailIdToJobSeekerExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_experience', function (Blueprint $table) {
            // Add the new foreign key column
            $table->unsignedInteger('seeker_detail_id')->nullable();

            // Create the foreign key constraint
            $table->foreign('seeker_detail_id')
                  ->references('id')
                  ->on('job_seeker_detail')
                  ->onDelete('SET NULL');
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
            // Drop the foreign key constraint
            $table->dropForeign(['seeker_detail_id']);

            // Drop the new foreign key column
            $table->dropColumn('seeker_detail_id');
        });
    }
}
