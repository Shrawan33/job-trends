<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToJobSeekerDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_education', function (Blueprint $table) {
            $table->index('user_id');
        });

        Schema::table('job_seeker_experience', function (Blueprint $table) {
            $table->index('user_id');
        });

        Schema::table('job_seeker_skill', function (Blueprint $table) {
            $table->index('user_id');
        });

        Schema::table('job_seeker_work_type', function (Blueprint $table) {
            $table->index('job_seeker_detail_id');
        });

        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->index('model_id');
            $table->index('role_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('hide_profile');
            $table->index('deleted_at');
        });

        Schema::table('job_seeker_detail', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('specialization_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_education', function (Blueprint $table) {
            $table->dropIndex('job_seeker_education_user_id_index');
        });

        Schema::table('job_seeker_experience', function (Blueprint $table) {
            $table->dropIndex('job_seeker_experience_user_id_index');
        });

        Schema::table('job_seeker_skill', function (Blueprint $table) {
            $table->dropIndex('job_seeker_skill_user_id_index');
        });

        Schema::table('job_seeker_work_type', function (Blueprint $table) {
            $table->dropIndex('job_seeker_work_type_job_seeker_detail_id_index');
        });

        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->dropIndex('model_has_roles_model_id_index');
            $table->dropIndex('model_has_roles_role_id_index');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_hide_profile_index');
            $table->dropIndex('users_deleted_at_index');
        });

        Schema::table('job_seeker_detail', function (Blueprint $table) {
            $table->dropIndex('job_seeker_detail_user_id_index');
            $table->dropIndex('job_seeker_detail_specialization_id_index');
        });
    }
}
