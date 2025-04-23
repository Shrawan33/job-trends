<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeJobAlertLocationFielName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('job_alerts', 'location')) {
            Schema::table('job_alerts', function (Blueprint $table) {
                $table->dropColumn('location');
            });
        }
        Schema::table('job_alerts', function (Blueprint $table) {
            $table->unsignedInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('SET NULL');

            $table->unsignedInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('SET NULL');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_alerts', function (Blueprint $table) {
            $table->dropForeign('job_alerts_location_id_foreign');
            $table->dropColumn('location_id');

            $table->dropForeign('job_alerts_state_id_foreign');
            $table->dropColumn('state_id');

            $table->dropForeign('job_alerts_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
