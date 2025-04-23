<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployerIdToCandidateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_notes', function (Blueprint $table) {
            $table->unsignedBigInteger('employer_id')->nullable();
            $table->unsignedBigInteger('candidate_id')->change();
            $table->foreign('employer_id')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_notes', function (Blueprint $table) {
            $table->dropForeign('candidate_notes_employer_id_foreign');

            $table->dropColumn('employer_id');
            $table->integer('candidate_id')->change();
        });
    }
}
