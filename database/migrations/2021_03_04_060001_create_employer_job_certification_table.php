<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployerJobCertificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_job_certifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employer_job_id')->nullable();
            $table->unsignedInteger('certification_id')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('employer_job_id')->references('id')->on('employer_jobs')->onDelete('SET NULL');
            $table->foreign('certification_id')->references('id')->on('certifications')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employer_job_certifications');
    }
}
