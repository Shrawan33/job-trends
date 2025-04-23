<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTcAndUrgencyToEmployerJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employer_jobs', function (Blueprint $table) {
            $table->boolean('tc_checkbox')->default(0);
            $table->boolean('is_urgent')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employer_jobs', function (Blueprint $table) {
            $table->dropColumn('tc_checkbox');
            $table->dropColumn('is_urgent');
        });
    }
}
