<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddItemEstimateQuotationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('add_item_estimate_quotation', function (Blueprint $table) {
            $table->unsignedBigInteger('estimate_quotation_id');
            $table->foreign('estimate_quotation_id', 'estimate_quotation_id_fk_10696830')->references('id')->on('estimate_quotations')->onDelete('cascade');
            $table->unsignedBigInteger('add_item_id');
            $table->foreign('add_item_id', 'add_item_id_fk_10696830')->references('id')->on('add_items')->onDelete('cascade');
        });
    }
}
