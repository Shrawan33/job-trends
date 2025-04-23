<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToJobSeekerDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_detail', function (Blueprint $table) {
            $table->string('professional_manner')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->tinyInteger('marital_status')->nullable();
            $table->tinyInteger('Religion')->nullable();
            $table->string('currently_staying_in')->nullable();
            $table->tinyInteger('visa_status')->nullable();
            $table->tinyInteger('Relocation')->nullable();
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
            $table->dropColumn([
                'professional_manner',
                'place_of_birth',
                'marital_status',
                'Religion',
                'currently_staying_in',
                'visa_status',
                'Relocation',
            ]);
        });
    }
}
