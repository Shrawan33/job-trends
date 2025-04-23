<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryIdToStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('states', function (Blueprint $table) {
            $table->unsignedInteger('country_id')->nullable();
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
        Schema::table('states', function (Blueprint $table) {
            $table->dropForeign('states_country_id_foreign');
            $table->dropColumn('country_id');
        });
    }
}
