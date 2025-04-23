<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionFieldInEmployerjob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employer_jobs', function (Blueprint $table) {
            $table->string('job_number')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->unsignedInteger('salary_type_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employer_jobs', function (Blueprint $table) {
            $table->dropColumn('job_number');
            $table->dropColumn('is_featured');
            $table->dropColumn('salary_type_id');
        });
    }
}
