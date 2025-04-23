<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLicenseFieldsToJobSeekerLicenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_license', function (Blueprint $table) {
            $table->string('certifying_authority')->nullable();
            $table->string('from_month')->nullable();
            $table->string('from_year')->nullable();
            $table->string('to_month')->nullable();
            $table->string('to_year')->nullable();
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
            $table->dropColumn(['certifying_authority', 'from_month', 'from_year', 'to_month', 'to_year']);
        });
    }
}
