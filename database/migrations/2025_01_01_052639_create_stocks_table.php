<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('stock_no');
            $table->integer('item_code')->unique();
            $table->string('item_name')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('location')->nullable();
            $table->unsignedBigInteger('store_id');
            $table->date('in_stock_date')->default(now()->toDate()->format('Y-m-d'));
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
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
        Schema::dropIfExists('stocks');
    }
}
