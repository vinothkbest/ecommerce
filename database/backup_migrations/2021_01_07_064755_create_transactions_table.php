<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreignId('subscription_id')->nullable();
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
            $table->string('transaction_id')->nullable();
            $table->string('transaction_status', 100)->nullable();
            $table->unsignedMediumInteger('amount')->nullable();
            $table->unsignedMediumInteger('validity')->nullable();
            $table->json('restriction')->comment('[{type:"image",upload_limit:10}]')->nullable();
            $table->json('balance')->comment('[{type:"image",upload_limit:2}]')->nullable();
            $table->dateTime('purchase_date')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('0-Expired 1-Active');
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
        Schema::dropIfExists('transactions');
    }
}
