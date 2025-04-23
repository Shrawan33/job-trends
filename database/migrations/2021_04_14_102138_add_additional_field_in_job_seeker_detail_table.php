<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldInJobSeekerDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_detail', function (Blueprint $table) {
            $table->text('parent_name')->nullable();
            $table->text('permanent_address')->nullable();
            $table->date('dob')->nullable();
            $table->text('language_known')->nullable();
            $table->tinyInteger('nationality')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_detail', function (Blueprint $table) {
            $table->dropColumn('parent_name');
            $table->dropColumn('permanent_address');
            $table->dropColumn('dob');
            $table->dropColumn('language_known');
            $table->dropColumn('nationality');
        });
    }
}
