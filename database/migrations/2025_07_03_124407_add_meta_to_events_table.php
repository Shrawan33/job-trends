<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetaToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('small_description');
            $table->text('meta_description')->nullable()->after('meta_title');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('small_description');
            $table->text('meta_description')->nullable()->after('meta_title');
        });

        Schema::table('employer_jobs', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('title');
            $table->text('meta_description')->nullable()->after('meta_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description']);

        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description']);

        });

        Schema::table('employer_jobs', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description']);
        });
    }
}
