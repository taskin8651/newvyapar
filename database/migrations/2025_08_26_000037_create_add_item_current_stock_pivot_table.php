<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddItemCurrentStockPivotTable extends Migration
{
    public function up()
    {
        Schema::create('add_item_current_stock', function (Blueprint $table) {
            $table->unsignedBigInteger('current_stock_id');
            $table->foreign('current_stock_id', 'current_stock_id_fk_10697368')->references('id')->on('current_stocks')->onDelete('cascade');
            $table->unsignedBigInteger('add_item_id');
            $table->foreign('add_item_id', 'add_item_id_fk_10697368')->references('id')->on('add_items')->onDelete('cascade');
        });
    }
}
