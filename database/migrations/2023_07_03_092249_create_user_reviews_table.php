<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('review_from_id')->nullable();
            $table->unsignedBigInteger('review_to_id')->nullable();

            $table->boolean('review_type')->nullable();
            $table->text('review')->nullable();
            
            $table->unsignedInteger('badge_id')->nullable();
            $table->json('badge_strength')->nullable();
            $table->json('badge_weekness')->nullable();

            $table->foreign('review_from_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('review_to_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('badge_id')->references('id')->on('badges')->onDelete('SET NULL');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_reviews');
    }
}
