<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriaLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criteria_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('criteria_id')->nullable();
            $table->integer('level')->nullable();
            $table->integer('score')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('criteria_id')->references('id')->on('criterias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('criteria_levels');
    }
}
