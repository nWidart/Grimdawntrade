<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item__auctions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
        Schema::create('item__prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('auction_id')->unsigned();
            $table->integer('item_id')->unsigned();
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
        Schema::dropIfExists('item__auctions');
        Schema::dropIfExists('item__prices');
    }
}
