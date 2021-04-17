<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('otp_created_at')->nullable();
            $table->boolean('otp_verification_status')->default('0')->comment('1 =verified 0=nonverified');
            $table->tinyInteger('status')->default(1)->comment("0-Disabled 1-Active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
