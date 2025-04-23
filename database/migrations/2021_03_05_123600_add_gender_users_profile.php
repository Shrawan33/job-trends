<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenderUsersProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_detail', function (Blueprint $table) {
            $table->tinyInteger('gender')->nullable();
            $table->string('title')->nullable();
            $table->double('salary')->nullable();
            $table->unsignedInteger('salary_type_id')->nullable();
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
            $table->dropColumn('gender');
            $table->dropColumn('title');
            $table->dropColumn('salary');
            $table->dropColumn('salary_type_id');
        });
    }
}
