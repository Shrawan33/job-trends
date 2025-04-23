<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferenceImportIdToCertificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certifications', function (Blueprint $table) {
            $table->integer('reference_import_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certifications', function (Blueprint $table) {
            $table->dropColumn('reference_import_id');
        });
    }
}
