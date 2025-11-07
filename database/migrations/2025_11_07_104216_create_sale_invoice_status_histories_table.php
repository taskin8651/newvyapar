<?php

// database/migrations/2025_11_07_000000_create_sale_invoice_status_histories_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sale_invoice_status_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_invoice_id');
            $table->string('old_status')->nullable();
            $table->string('new_status');
            $table->text('remark')->nullable();
            $table->unsignedBigInteger('changed_by_id');
            $table->timestamps();

            $table->foreign('sale_invoice_id')->references('id')->on('sale_invoices')->onDelete('cascade');
            $table->foreign('changed_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['sale_invoice_id', 'created_at']);
        });

        // Optional: add default status column constraint/enum-like check (skip if MySQL < 8)
        // DB::statement("ALTER TABLE sale_invoices MODIFY status VARCHAR(20) NULL");
    }

    public function down(): void {
        Schema::dropIfExists('sale_invoice_status_histories');
    }
};
