<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_product_id')->nullable();
            $table->foreign('order_product_id')->references('id')->on('order_products');
            $table->foreignId('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string('size', 10)->nullable();
            $table->string('color', 50)->comment('#000000||Black')->nullable();
            $table->string('quantity', 50)->nullable();
            $table->string('actual_price')->nullable();
            $table->string('total_price')->nullable();
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
        Schema::dropIfExists('order_product_variants');
    }
}