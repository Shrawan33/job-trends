<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployerJobsSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('employer_jobs', 'skill_id')) {
            Schema::table('employer_jobs', function (Blueprint $table) {
                $table->dropForeign('employer_jobs_skill_id_foreign');
                $table->dropColumn('skill_id');
            });
        }
        Schema::create('employer_jobs_skill', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employer_job_id')->nullable();
            $table->unsignedInteger('skill_id')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('employer_job_id')->references('id')->on('employer_jobs')->onDelete('SET NULL');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employer_jobs_skill');
    }
}
