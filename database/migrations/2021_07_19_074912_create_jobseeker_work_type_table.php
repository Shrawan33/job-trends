<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobseekerWorkTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('job_seeker_work_type', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_seeker_detail_id')->nullable();
            $table->unsignedInteger('work_type_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('job_seeker_detail_id')->references('id')->on('job_seeker_detail')->onDelete('SET NULL');
            $table->foreign('work_type_id')->references('id')->on('work_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('job_seeker_work_type');
    }
}
