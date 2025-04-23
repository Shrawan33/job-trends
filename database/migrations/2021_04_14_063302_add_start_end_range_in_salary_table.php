<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartEndRangeInSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salaries', function (Blueprint $table) {
            $table->integer('start')->nullable();
            $table->integer('end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salaries', function (Blueprint $table) {
            $table->dropColumn('start');
            $table->dropColumn('end');
        });
    }
}
