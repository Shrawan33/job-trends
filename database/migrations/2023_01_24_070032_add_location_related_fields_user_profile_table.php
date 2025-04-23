<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationRelatedFieldsUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_profile', function (Blueprint $table) {
            $table->unsignedInteger('state_id')->nullable();
            $table->unsignedInteger('location_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('SET NULL');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('SET NULL');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_profile', function (Blueprint $table) {
            $table->dropForeign(['state_id']);
            $table->dropForeign(['location_id']);
            $table->dropForeign(['country_id']);
            $table->dropColumn('state_id');
            $table->dropColumn('location_id');
            $table->dropColumn('country_id');
        });
    }
}
