<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_lists', function (Blueprint $table) {
            $table->id();
            $table->string('contentable_type')->nullable();
            $table->unsignedBigInteger('contentable_id')->nullable();
            $table->string('title');
            $table->string('keyword');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('seo_lists');
    }
}
