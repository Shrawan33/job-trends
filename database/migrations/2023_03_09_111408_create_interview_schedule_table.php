<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_schedule', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employer_job_id');
            $table->string('users')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('interview_link')->nullable();
            $table->datetime('datetime')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interview_schedule');
    }
}
