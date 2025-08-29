<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddItemSaleInvoicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('add_item_sale_invoice', function (Blueprint $table) {
            $table->unsignedBigInteger('sale_invoice_id');
            $table->foreign('sale_invoice_id', 'sale_invoice_id_fk_10696786')->references('id')->on('sale_invoices')->onDelete('cascade');
            $table->unsignedBigInteger('add_item_id');
            $table->foreign('add_item_id', 'add_item_id_fk_10696786')->references('id')->on('add_items')->onDelete('cascade');
        });
    }
}
