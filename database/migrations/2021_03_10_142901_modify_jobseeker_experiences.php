<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyJobseekerExperiences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('job_seeker_experience', 'roll')) {
            Schema::table('job_seeker_experience', function (Blueprint $table) {
                $table->renameColumn('roll', 'role');
            });
        }

        if (Schema::hasColumn('job_seeker_experience', 'experience_id')) {
            Schema::table('job_seeker_experience', function (Blueprint $table) {
                $table->dropForeign('job_seeker_experience_experience_id_foreign');
                $table->dropColumn('experience_id');
            });
        }

        if (Schema::hasColumn('job_seeker_experience', 'salary_id')) {
            Schema::table('job_seeker_experience', function (Blueprint $table) {
                $table->dropForeign('job_seeker_experience_salary_id_foreign');
                $table->dropColumn('salary_id');
            });
        }

        Schema::table('job_seeker_experience', function (Blueprint $table) {
            $table->text('description')->nullable();
        });

        Schema::table('job_seeker_detail', function (Blueprint $table) {
            $table->integer('total_experience')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('job_seeker_detail', 'total_experience')) {
            Schema::table('job_seeker_detail', function (Blueprint $table) {
                $table->dropColumn('total_experience');
            });
        }

        if (Schema::hasColumn('job_seeker_experience', 'description')) {
            Schema::table('job_seeker_experience', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }
    }
}
