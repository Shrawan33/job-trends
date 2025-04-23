<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBadgeIdToReviewCategoryStrengthWeeknessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('review_category_strength_weeknesses', function (Blueprint $table) {
            $table->dropForeign(['review_category_id']);

            // Remove the review_category_id field
            $table->dropColumn('review_category_id');

            // Add the new badge_id field
            $table->unsignedInteger('badge_id')->nullable();

            // Add foreign key constraint to the badges table
            $table->foreign('badge_id')->references('id')->on('badges')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_category_strength_weeknesses', function (Blueprint $table) {
            $table->dropForeign(['badge_id']);

            // Drop the badge_id field
            $table->dropColumn('badge_id');

            // Recreate the review_category_id field with foreign key constraint
            $table->unsignedInteger('review_category_id')->nullable();
            $table->foreign('review_category_id')->references('id')->on('review_categories')->onDelete('SET NULL');
        });
    }
}
