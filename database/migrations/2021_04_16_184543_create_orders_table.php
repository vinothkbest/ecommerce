<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->json("shipping_address");
            $table->json("order_summary");
            $table->string("parcel_id")->nullable();
            $table->boolean("is_delivered")->comment("0 not delivered");
            $table->boolean("is_cancelled")->comment("1 is cancelled");
            $table->dateTime('delivered_date')->nullable();
            $table->dateTime('cancelled_date')->nullable()->comment("if canclled");
            $table->boolean("is_cart")->comment("0 is buy item; 1 is cart item");
            $table->boolean("status");
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('set null');
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
        Schema::dropIfExists('orders');
    }
}
