<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialMediaLinksToJobSeekerDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_detail', function (Blueprint $table) {
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('blog_url')->nullable();
            $table->string('linkedin_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_detail', function (Blueprint $table) {
            $table->dropColumn('facebook_url');
            $table->dropColumn('instagram_url');
            $table->dropColumn('blog_url');
            $table->dropColumn('linkedin_url');
        });
    }
}
