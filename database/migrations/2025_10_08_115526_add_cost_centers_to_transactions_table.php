<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('main_cost_center_id')->nullable()->after('select_customer_id');
            $table->unsignedBigInteger('sub_cost_center_id')->nullable()->after('main_cost_center_id');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['main_cost_center_id', 'sub_cost_center_id']);
        });
    }
};
