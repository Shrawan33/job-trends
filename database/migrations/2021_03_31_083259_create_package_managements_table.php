<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->float('price', 8, 2)->nullable();
            $table->tinyInteger('duration')->nullable();
            $table->tinyInteger('grace_period')->nullable();
            $table->integer('profile_unlock_credits')->nullable();
            $table->integer('no_of_job_posts')->nullable();
            $table->integer('no_of_sms')->nullable();
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
        Schema::drop('packages');
    }
}
