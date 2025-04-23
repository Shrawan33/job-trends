<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCertificateIdAndAddCertificateNameToJobSeekerLicenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_license', function (Blueprint $table) {
            $table->dropForeign('job_seeker_license_certificate_id_foreign');

            // Drop the 'certificate_id' column
            $table->dropColumn('certificate_id');

            // Add the 'certificate_name' column
            $table->string('certificate_name')->nullable();
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
            $table->integer('certificate_id')->unsigned();
            $table->dropColumn('certificate_name');
        });
    }
}
