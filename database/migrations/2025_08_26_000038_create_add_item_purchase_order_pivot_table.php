<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddItemPurchaseOrderPivotTable extends Migration
{
    public function up()
    {
        Schema::create('add_item_purchase_order', function (Blueprint $table) {
            $table->unsignedBigInteger('purchase_order_id');
            $table->foreign('purchase_order_id', 'purchase_order_id_fk_10697516')->references('id')->on('purchase_orders')->onDelete('cascade');
            $table->unsignedBigInteger('add_item_id');
            $table->foreign('add_item_id', 'add_item_id_fk_10697516')->references('id')->on('add_items')->onDelete('cascade');
        });
    }
}
