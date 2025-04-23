<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMonthsToJobSeekerEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_education', function (Blueprint $table) {
            $table->string('from_month')->nullable();
            $table->string('to_month')->nullable();
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
            $table->dropColumn(['from_month', 'to_month']);
        });
    }
}
