<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFiledsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->boolean('tc_checkbox')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('tc_checkbox');
        });
    }
}
