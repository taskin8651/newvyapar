<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sale_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_invoice_id');
            $table->unsignedBigInteger('item_id'); // add_item_id
            $table->string('item_type')->nullable(); // product or service
            $table->unsignedBigInteger('stock_id')->nullable(); // current_stocks id if product
            $table->integer('previous_qty')->nullable();
            $table->integer('sold_qty')->nullable();
            $table->decimal('previous_amount', 15, 2)->nullable();
            $table->decimal('sold_amount', 15, 2)->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('created_by_id')->nullable();
            $table->json('json_data_add_item_sale_invoice')->nullable();
            $table->json('json_data_current_stock')->nullable();
            $table->json('json_data_sale_invoice')->nullable(); // supplier id
            $table->unsignedBigInteger('sold_to_user_id')->nullable(); // customer id
            $table->timestamps();

            $table->foreign('sale_invoice_id')->references('id')->on('sale_invoices')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_logs');
    }
};
