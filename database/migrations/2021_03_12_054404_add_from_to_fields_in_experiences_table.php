<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFromToFieldsInExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->integer('from')->nullable();
            $table->integer('to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn('from');
            $table->dropColumn('to');
        });
    }
}
