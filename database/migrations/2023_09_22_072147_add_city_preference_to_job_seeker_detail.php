<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityPreferenceToJobSeekerDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('job_seeker_detail', 'city_preference')) {
            Schema::table('job_seeker_detail', function (Blueprint $table) {
                // Add the city_preference column as JSON type and make it nullable
                $table->json('city_preference')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_detail', function (Blueprint $table) {
            // Reverse the migration by dropping the city_preference column if it exists
            if (Schema::hasColumn('job_seeker_detail', 'city_preference')) {
                $table->dropColumn('city_preference');
            }
        });
    }
}
