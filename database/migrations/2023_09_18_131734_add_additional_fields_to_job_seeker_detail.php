<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToJobSeekerDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_detail', function (Blueprint $table) {
            $table->string('Job_preference')->nullable();
            $table->unsignedInteger('city_preference')->nullable();
            $table->foreign('city_preference')->references('id')->on('locations')->onDelete('SET NULL');
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->string('current_salary')->nullable();
            $table->string('expected_salary')->nullable();
            $table->boolean('is_fresher')->default(0);
            $table->string('current_position')->nullable();
            $table->string('current_company')->nullable();
            $table->string('training_name')->nullable();
            $table->string('attended_at_company')->nullable();
            $table->string('year')->nullable();
            $table->text('personal_statement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_detail', function (Blueprint $table) {
            $table->dropColumn([
                'Job_preference',
                'city_preference',
                'category_id',
                'current_salary',
                'expected_salary',
                'is_fresher',
                'current_position',
                'current_company',
                'training_name',
                'attended_at_company',
                'year',
                'personal_statement',
            ]);
        });
    }
}
