<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsHardcoreColumnOnAuctions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item__auctions', function (Blueprint $table) {
            $table->boolean('is_hardcore')->default(0)->nullable()->after('item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item__auctions', function (Blueprint $table) {
            $table->dropColumn('is_hardcore');
        });
    }
}
