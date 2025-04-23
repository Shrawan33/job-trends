<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignEmployerAccountMangerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_employer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employer_id')->nullable();
            $table->unsignedBigInteger('account_manager_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('employer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('account_manager_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assign_employer');
    }
}
