<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_bill_id')->nullable();
            $table->unsignedBigInteger('select_customer_id');
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->decimal('purchase_amount', 15, 2)->default(0);
            $table->decimal('opening_balance', 15, 2)->default(0);
            $table->decimal('closing_balance', 15, 2)->default(0);
            $table->string('transaction_type')->nullable(); // e.g. purchase, sale, etc.
            $table->string('transaction_id', 20)->unique();
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->json('json_data')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
