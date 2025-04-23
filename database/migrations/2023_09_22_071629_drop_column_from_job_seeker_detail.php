<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnFromJobSeekerDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_detail', function (Blueprint $table) {
            if (Schema::hasColumn('job_seeker_detail', 'city_preference')) {
                $table->dropForeign(['city_preference']);
                $table->dropColumn('city_preference');
            }
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
            //
        });
    }
}
