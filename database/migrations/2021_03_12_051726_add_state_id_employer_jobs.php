<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStateIdEmployerJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employer_jobs', function (Blueprint $table) {
            $table->unsignedInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('SET NULL');

            $table->string('area')->nullable();
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
            $table->dropForeign('employer_jobs_state_id_foreign');
            $table->dropColumn('state_id');

            $table->dropColumn('area');
        });
    }
}
