<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_ins', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('parties_id')->nullable(); // Party relation
            $table->unsignedBigInteger('payment_type_id')->nullable(); // BankAccount relation

            $table->date('date')->nullable();
            $table->string('reference_no')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->decimal('discount', 15, 2)->nullable();
            $table->decimal('total', 15, 2)->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('updated_by_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Foreign keys (optional, uncomment if you want constraints)
            // $table->foreign('parties_id')->references('id')->on('party_details')->onDelete('set null');
            // $table->foreign('payment_type_id')->references('id')->on('bank_accounts')->onDelete('set null');
            // $table->foreign('created_by_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_ins');
    }
};
