<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInLocationFieldJobSeekerDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('employer_jobs', 'location')) {
            Schema::table('employer_jobs', function (Blueprint $table) {
                $table->dropColumn('location');
            });
        }

        if (Schema::hasColumn('job_seeker_detail', 'location')) {
            Schema::table('job_seeker_detail', function (Blueprint $table) {
                $table->dropColumn('location');
            });
        }

        Schema::table('job_seeker_detail', function (Blueprint $table) {
            $table->unsignedInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('SET NULL');
        });

        Schema::table('employer_jobs', function (Blueprint $table) {
            $table->unsignedInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('SET NULL');
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
            $table->dropForeign('job_seeker_detail_location_id_foreign');
            $table->dropColumn('location_id');
        });
        Schema::table('employer_jobs', function (Blueprint $table) {
            $table->dropForeign('employer_jobs_location_id_foreign');
            $table->dropColumn('location_id');
        });
    }
}
