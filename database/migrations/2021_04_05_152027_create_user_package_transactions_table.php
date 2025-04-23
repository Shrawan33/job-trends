<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPackageTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_package_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_package_id');
            $table->string('credit_type');
            $table->unsignedBigInteger('transactable_id');
            $table->string('transactable_type');
            $table->unsignedInteger('deducted_credit');
            $table->unsignedInteger('remaining_credit');
            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_package_id')->references('id')->on('user_packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_package_transactions');
    }
}
