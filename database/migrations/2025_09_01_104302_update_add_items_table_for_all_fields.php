<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('add_items', function (Blueprint $table) {
            $table->integer('opening_stock')->nullable();
            $table->integer('low_stock_warning')->nullable();
            $table->string('warehouse_location')->nullable();
            $table->string('online_store_title')->nullable();
            $table->longText('online_store_description')->nullable();
            $table->string('online_store_image')->nullable();
            $table->longText('json_data')->nullable();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('add_items', function (Blueprint $table) {
            //
        });
    }
};
