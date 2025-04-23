<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveToMonthAndToYearFromJobSeekerLicenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_license', function (Blueprint $table) {
            $table->dropColumn('to_month');
            $table->dropColumn('to_year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_license', function (Blueprint $table) {
            $table->string('to_month')->nullable();
            $table->integer('to_year')->nullable();
        });
    }
}
