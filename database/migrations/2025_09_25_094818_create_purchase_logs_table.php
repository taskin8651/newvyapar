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
    Schema::create('purchase_logs', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->index();
        $table->unsignedBigInteger('party_id')->nullable();
        $table->unsignedBigInteger('main_cost_center_id')->nullable();
        $table->unsignedBigInteger('sub_cost_center_id')->nullable();
        $table->unsignedBigInteger('payment_type_id')->nullable();
        $table->json('items')->nullable(); // product/service ids
        $table->json('extra_data')->nullable(); // baki fields
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_logs');
    }
};
