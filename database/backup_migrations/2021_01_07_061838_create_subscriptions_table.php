<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('type', 30)->default('basic');
            $table->string('name', 50)->nullable();
            $table->unsignedMediumInteger('amount')->nullable();
            $table->unsignedMediumInteger('validity')->nullable();
            $table->json('restriction')->comment('[{type:"image",upload_limit:10}]')->nullable();
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('0-Disabled 1-Active');
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
        Schema::dropIfExists('subscriptions');
    }
}
