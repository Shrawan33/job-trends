<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovalStatusToEmployerJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employer_jobs', function (Blueprint $table) {
            $table->tinyInteger('approval_status')->default(0)->comment('0 -  Waiting for Review, 1 - Approved, 2 - Rejected, 3 - Cancelled ');
            $table->text('approval_status_reason')->nullable();
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
            $table->dropColumn('approval_status');
            $table->dropColumn('approval_status_reason');
        });
    }
}
