<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppliedJobQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applied_job_questionnaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('applied_job_id');
            $table->unsignedInteger('questionnaire_id');
            $table->text('answer')->nullable();
            $table->unsignedInteger('option_id')->nullable();
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');

            $table->foreign('applied_job_id')->references('id')->on('applied_jobs')->onDelete('cascade');
            $table->foreign('questionnaire_id')->references('id')->on('questionnaire')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('applied_job_questionnaires');
    }
}
