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
        Schema::create('productions', function (Blueprint $table) {
            $table->id();

            $table->string('reference_no')->unique();

            $table->foreignId('finished_good_id')->constrained();
            $table->decimal('finished_qty', 15, 2);

            $table->decimal('total_raw_cost', 15, 2)->default(0);
            $table->decimal('total_production_cost', 15, 2)->default(0);
            $table->decimal('profit', 15, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productions');
    }
};
