<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeLicenseFieldJobseekerLicenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_license', function (Blueprint $table) {
            $table->dropColumn('license_title');
            $table->unsignedInteger('certificate_id')->nullable();

            $table->foreign('certificate_id')->references('id')->on('certifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_license', function (Blueprint $table) {
            $table->dropForeign('job_seeker_license_certificate_id_foreign');
            $table->dropColumn('certificate_id');
            $table->string('license_title')->nullable();
        });
    }
}
