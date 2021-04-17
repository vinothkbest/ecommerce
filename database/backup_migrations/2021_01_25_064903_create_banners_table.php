<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('image', 100)->nullable();
            $table->unsignedTinyInteger('type')->comment('1-CategoryScreen 2-ProductListScreen 3-ProductDetailScreen 4-ExhibitionScreen')->nullable();
            $table->string('type_id')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('0-disabled 1-Active');
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
        Schema::dropIfExists('banners');
    }
}
