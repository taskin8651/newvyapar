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
        Schema::create('finished_goods', function (Blueprint $table) {
            $table->id();

            $table->string('unique_code')->unique();
            $table->string('buyer_code')->nullable();

            $table->string('title');
            $table->string('item_code')->nullable();
            $table->string('item_hsn')->nullable();

            $table->string('unit');
            $table->decimal('quantity', 15, 2)->default(0);

            $table->decimal('manufacturing_cost', 15, 2)->default(0);
            $table->decimal('sale_price', 15, 2)->nullable();
            $table->decimal('profit_per_unit', 15, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finished_goods');
    }
};
