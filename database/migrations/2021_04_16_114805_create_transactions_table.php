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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string("txn_id");
            $table->string('payumoney_id');
            $table->string("pay_mode")->nullable();
            $table->json("product_info")->nullable();
            $table->string("email")->nullable();
            $table->string("mobile")->nullable();
            $table->string("customer_name")->nullable();
            $table->string("ordered_price");
            $table->string("bank_ref_num")->nullable();
            $table->string("pay_status");
            $table->string("capture_status")->nullable();
            $table->boolean("is_refunded")->nullable()->comment("when failure happens, 0 not refunded 1 refunded");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
