<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreditDeductionPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->json('credit_info')->nullable();
            $table->dropColumn('profile_unlock_credits');
            $table->dropColumn('no_of_job_posts');
            $table->dropColumn('no_of_sms');
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
            $table->dropColumn('credit_info');
            $table->integer('profile_unlock_credits')->nullable();
            $table->integer('no_of_job_posts')->nullable();
            $table->integer('no_of_sms')->nullable();
        });
    }
}
