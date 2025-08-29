<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProformaInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('proforma_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('billing_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('e_way_bill_no')->nullable();
            $table->longText('billing_address')->nullable();
            $table->longText('shipping_address')->nullable();
            $table->string('po_no')->nullable();
            $table->date('po_date')->nullable();
            $table->integer('qty');
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
