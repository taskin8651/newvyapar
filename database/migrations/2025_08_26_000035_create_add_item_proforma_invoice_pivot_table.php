<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddItemProformaInvoicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('add_item_proforma_invoice', function (Blueprint $table) {
            $table->unsignedBigInteger('proforma_invoice_id');
            $table->foreign('proforma_invoice_id', 'proforma_invoice_id_fk_10696848')->references('id')->on('proforma_invoices')->onDelete('cascade');
            $table->unsignedBigInteger('add_item_id');
            $table->foreign('add_item_id', 'add_item_id_fk_10696848')->references('id')->on('add_items')->onDelete('cascade');
        });
    }
}
