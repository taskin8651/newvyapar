<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->id();

            // Party details
            $table->foreignId('party_id')->constrained('party_details')->onDelete('cascade');
            $table->string('party_name')->nullable();
            $table->enum('opening_balance_type', ['Debit', 'Credit'])->nullable();
            $table->decimal('current_balance', 15, 2)->nullable();
            $table->enum('current_balance_type', ['Debit', 'Credit'])->nullable();

            // Bank / Payment
            $table->foreignId('payment_type_id')->nullable()->constrained('bank_accounts')->onDelete('set null');

            // Transaction amount
            $table->decimal('amount', 15, 2);

            // Auditing
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by_id')->nullable()->constrained('users')->onDelete('set null');

            // Other info
            $table->text('description')->nullable();

            // Meta
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_transactions');
    }
};
