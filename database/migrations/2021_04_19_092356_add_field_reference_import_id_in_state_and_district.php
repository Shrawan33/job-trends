<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldReferenceImportIdInStateAndDistrict extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('states', 'refrence_import_id')) {
            Schema::table('states', function (Blueprint $table) {
                    $table->integer('refrence_import_id')->nullable();
            });
        }
        if (!Schema::hasColumn('locations', 'refrence_import_id')) {
            Schema::table('locations', function (Blueprint $table) {
                $table->integer('refrence_import_id')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('states', function (Blueprint $table) {
            $table->dropColumn('refrence_import_id');
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('refrence_import_id');
        });
    }
}
