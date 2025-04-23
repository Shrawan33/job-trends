<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            // Add package_category field
            $table->unsignedInteger('package_category_id')->nullable();
            $table->foreign('package_category_id')->references('id')->on('package_categories')->onDelete('SET NULL');

            // Add is_addon field
            $table->boolean('is_addon')->default(0);
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
            // Drop foreign key constraint
            $table->dropForeign(['package_category_id']);

            // Drop the added fields
            $table->dropColumn('package_category_id');
            $table->dropColumn('is_addon');
        });
    }
}
