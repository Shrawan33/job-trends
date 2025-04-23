<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('entity_type')->default(0)->comment('0=plan/package,1=video,2=disctest');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->uuid('session_id');
            $table->float('amount');
            $table->string('token')->nullable();
            $table->tinyInteger('transaction_status')->nullable();
            $table->json('transaction_response')->nullable();
            $table->boolean('renew_package')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
        });

        Schema::table('user_packages', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_packages', function (Blueprint $table) {
            $table->dropForeign('user_packages_payment_id_foriegn');
            $table->dropColumn('payment_id');
        });

        Schema::drop('payments');
    }
}
