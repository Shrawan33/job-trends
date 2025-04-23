<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferenceFieldsToJobSeekerExperience extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_experience', function (Blueprint $table) {
            $table->string('reference_name')->nullable();
            $table->string('reference_phone_number')->nullable();
            $table->string('reference_position')->nullable();
            $table->integer('years_known')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_experience', function (Blueprint $table) {
            $table->dropColumn('reference_name');
            $table->dropColumn('reference_phone_number');
            $table->dropColumn('reference_position');
            $table->dropColumn('years_known');
        });
    }
}
