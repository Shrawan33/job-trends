<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekerDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seeker_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('cover_title')->nullable();
            $table->text('cover_desc')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
        });

        Schema::create('job_seeker_education', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('qualification_id')->nullable();
            $table->text('university')->nullable();
            $table->string('year')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('qualification_id')->references('id')->on('qualifications')->onDelete('SET NULL');
        });

        Schema::create('job_seeker_experience', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('experience_id')->nullable();
            $table->text('company')->nullable();
            $table->string('year_range')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('experience_id')->references('id')->on('experiences')->onDelete('SET NULL');
        });

        Schema::create('job_seeker_license', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('license_title')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
        });

        Schema::create('job_seeker_skill', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('skill_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('SET NULL');
        });

        Schema::create('job_seeker_video', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('video_url')->nullable();
            $table->string('video_title')->nullable();
            $table->text('video_description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
        });

        Schema::create('job_seeker_disc', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('disc_url')->nullable();
            $table->string('disc_title')->nullable();
            $table->text('disc_description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_seeker_detail');
        Schema::dropIfExists('job_seeker_education');
        Schema::dropIfExists('job_seeker_experience');
        Schema::dropIfExists('job_seeker_license');
        Schema::dropIfExists('job_seeker_skill');
        Schema::dropIfExists('job_seeker_video');
        Schema::dropIfExists('job_seeker_disc');
    }
}
