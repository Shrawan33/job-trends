<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAndRecreateCityPreferenceColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop the existing column if it exists
        Schema::table('job_seeker_detail', function (Blueprint $table) {
            //  $table->dropForeign(['job_seeker_detail_city_preference_foreign']);
            // Schema::dropIfExists('city_preference');
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
            $table->unsignedInteger('city_preference')->nullable()->default(0);
        });
    }
}
