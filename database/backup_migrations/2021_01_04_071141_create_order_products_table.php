<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreignId('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('actual_price')->nullable();
            $table->string('total_quantity')->nullable();
            $table->string('total_price')->nullable();
            $table->string('total_variant')->nullable();
            $table->json('meta')->comment('{"vendor_id":"1","category_id":"2","brand_id":"1","name":"yr","actual_price":"100","discount":"10","fixed_price":"90","description":"product detail"}');
            $table->unsignedTinyInteger('status')->default(1)->comment('0-Disabled 1-Pending 2-Delivered');
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
        Schema::dropIfExists('order_products');
    }
}