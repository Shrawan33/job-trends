<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_verifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('mobile_verification_code');
            $table->string('email_verification_code');
            $table->unsignedSmallInteger('verification_type')->comment('1=registration, 2=login')->default(1);
            $table->boolean('mobile_verified')->default(0);
            $table->boolean('email_verified')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('mobile_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_verifications');
    }
}
