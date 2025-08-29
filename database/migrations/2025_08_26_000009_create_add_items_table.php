<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddItemsTable extends Migration
{
    public function up()
    {
        Schema::create('add_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_type')->nullable();
            $table->string('item_name');
            $table->string('item_hsn');
            $table->string('item_code');
            $table->string('sale_price');
            $table->string('select_type')->nullable();
            $table->string('disc_on_sale_price')->nullable();
            $table->string('disc_type')->nullable();
            $table->string('wholesale_price')->nullable();
            $table->string('select_type_wholesale')->nullable();
            $table->string('minimum_wholesale_qty')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('select_purchase_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
