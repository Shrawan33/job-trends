<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployerJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('subcategory_id')->nullable();
            $table->text('description')->nullable();
            $table->string('company_name')->nullable();
            $table->text('company_profile')->nullable();
            $table->unsignedInteger('work_type_id')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('website')->nullable();
            $table->unsignedInteger('skill_id')->nullable();
            $table->string('location')->nullable();
            $table->unsignedInteger('experience_id')->nullable();
            $table->unsignedInteger('salary_id')->nullable();
            $table->unsignedInteger('interview_type_id')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('subcategory_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('work_type_id')->references('id')->on('work_types')->onDelete('SET NULL');
            $table->foreign('interview_type_id')->references('id')->on('interview_types')->onDelete('SET NULL');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('SET NULL');
            $table->foreign('experience_id')->references('id')->on('experiences')->onDelete('SET NULL');
            $table->foreign('salary_id')->references('id')->on('salaries')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employer_jobs');
    }
}
