<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->unsignedSmallInteger('duration')->nullable()->change();
            $table->unsignedSmallInteger('grace_period')->nullable()->change();
            $table->boolean('is_default')->default(false);
            $table->boolean('is_contact_sales')->default(false);
            $table->boolean('is_best_selling')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('is_default');
            $table->dropColumn('is_contact_sales');
            $table->dropColumn('is_best_selling');
        });
    }
}
