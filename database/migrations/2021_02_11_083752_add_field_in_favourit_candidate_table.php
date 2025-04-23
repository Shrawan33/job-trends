<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldInFavouritCandidateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('favourite_candidates', function (Blueprint $table) {
           $table->boolean('mail_send')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('favourite_candidates', function (Blueprint $table) {
            $table->dropColumn('mail_send');
        });
    }
}
