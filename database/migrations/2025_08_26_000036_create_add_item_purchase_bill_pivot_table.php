<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddItemPurchaseBillPivotTable extends Migration
{
    public function up()
    {
        Schema::create('add_item_purchase_bill', function (Blueprint $table) {
            $table->unsignedBigInteger('purchase_bill_id');
            $table->foreign('purchase_bill_id', 'purchase_bill_id_fk_10697037')->references('id')->on('purchase_bills')->onDelete('cascade');
            $table->unsignedBigInteger('add_item_id');
            $table->foreign('add_item_id', 'add_item_id_fk_10697037')->references('id')->on('add_items')->onDelete('cascade');
        });
    }
}
