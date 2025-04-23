<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherFieldsInJobseekerEducationExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_education', function (Blueprint $table) {
            $table->boolean('entitled')->default(0);
        });

        Schema::table('job_seeker_experience', function (Blueprint $table) {
            $table->string('roll')->nullable();
            $table->unsignedInteger('salary_id')->nullable();

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
        Schema::table('job_seeker_education', function (Blueprint $table) {
            $table->dropColumn('entitled');
        });

        Schema::table('job_seeker_experience', function (Blueprint $table) {
            $table->dropColumn('roll');
            $table->dropForeign('job_seeker_experience_salary_id_foreign');
            $table->dropColumn('salary_id');
        });
    }
}
