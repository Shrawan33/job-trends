<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewCategoryStrengthWeeknessesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_category_strength_weeknesses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('review_category_id')->nullable();
            $table->integer('review_category_type');
            $table->string('title');
            $table->softDeletes();

            $table->boolean('is_deleted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');

            $table->foreign('review_category_id')->references('id')->on('review_categories')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('review_category_strength_weeknesses');
    }
}
