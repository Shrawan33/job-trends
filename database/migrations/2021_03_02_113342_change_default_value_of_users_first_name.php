<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDefaultValueOfUsersFirstName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->change();
            $table->text('company_name')->change();
            $table->string('phone_number')->nullable();
        });

        if (Schema::hasColumn('job_seeker_detail', 'phone_number')) {
            Schema::table('job_seeker_detail', function (Blueprint $table) {
                $table->dropColumn('phone_number');
            });
        }

        if (Schema::hasColumn('users_profile', 'phone_number')) {
            Schema::table('users_profile', function (Blueprint $table) {
                $table->dropColumn('phone_number');
            });
        }

        if (Schema::hasColumn('users_profile', 'company_name')) {
            Schema::table('users_profile', function (Blueprint $table) {
                $table->dropColumn('company_name');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_number');
        });
    }
}
