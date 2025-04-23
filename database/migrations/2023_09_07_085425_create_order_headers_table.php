<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_headers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('order_number')->unique();
            $table->double('total_amount', 8, 2);
            $table->json('item_info');

            $table->json('user_info')->nullable();
            $table->tinyInteger('payment_status')->default(0);
            $table->json('payment_info');
            $table->tinyInteger('order_process_status')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_headers');
    }
}
