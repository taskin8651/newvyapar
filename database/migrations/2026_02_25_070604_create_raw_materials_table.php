<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();

            $table->string('unique_code')->unique();
            $table->string('buyer_code')->nullable();

            $table->string('title');
            $table->string('item_code')->nullable();
            $table->string('item_hsn')->nullable();

            $table->string('unit'); // kg, pcs, liter
            $table->string('unit_type')->nullable(); // small / large

            $table->decimal('quantity', 15, 2)->default(0);

            $table->decimal('purchase_price', 15, 2)->nullable();
            $table->decimal('sale_price', 15, 2)->nullable();

            $table->boolean('with_tax')->default(true);
            $table->decimal('tax_percent', 8, 2)->nullable();

            $table->decimal('low_stock_warning', 15, 2)->nullable();
            $table->string('warehouse_location')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_materials');
    }
};
