<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAnonymousToUserReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_reviews', function (Blueprint $table) {
            $table->boolean('is_anonymous')->default(0)->after('approval_status_reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_reviews', function (Blueprint $table) {
            $table->dropColumn('is_anonymous');
        });
    }
}
