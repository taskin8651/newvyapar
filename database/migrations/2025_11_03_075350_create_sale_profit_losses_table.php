<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleProfitLossesTable extends Migration
{
    public function up()
    {
        Schema::create('sale_profit_losses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_invoice_id');
            $table->unsignedBigInteger('select_customer_id')->nullable();
            $table->unsignedBigInteger('main_cost_center_id')->nullable();
            $table->unsignedBigInteger('sub_cost_center_id')->nullable();
            $table->decimal('total_purchase_value', 16, 2)->default(0);
            $table->decimal('total_sale_value', 16, 2)->default(0);
            $table->decimal('profit_loss_amount', 16, 2)->default(0);
            $table->boolean('is_profit')->default(true);
            $table->longText('composition_json')->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->timestamps();

            $table->index('sale_invoice_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sale_profit_losses');
    }
} ;