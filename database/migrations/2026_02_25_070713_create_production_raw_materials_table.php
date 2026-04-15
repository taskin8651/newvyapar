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
        Schema::create('production_raw_materials', function (Blueprint $table) {
            $table->id();

            $table->foreignId('production_id')->constrained()->cascadeOnDelete();
            $table->foreignId('raw_material_id')->constrained();

            $table->decimal('used_qty', 15, 2);
            $table->decimal('purchase_price', 15, 2);
            $table->decimal('tax_percent', 8, 2)->nullable();
            $table->decimal('total_cost', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_raw_materials');
    }
};
