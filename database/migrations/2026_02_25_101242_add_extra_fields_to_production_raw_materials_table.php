<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('production_raw_materials', function (Blueprint $table) {

            $table->foreignId('finished_good_id')
                  ->nullable()
                  ->after('production_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->decimal('base_cost', 15, 2)->default(0)->after('purchase_price');
            $table->decimal('tax_amount', 15, 2)->default(0)->after('tax_percent');

            $table->string('warehouse_location')->nullable();
            $table->string('batch_no')->nullable();

            $table->foreignId('created_by_id')->nullable()->constrained('users');
        });
    }

    public function down()
    {
        Schema::table('production_raw_materials', function (Blueprint $table) {
            $table->dropColumn([
                'finished_good_id',
                'base_cost',
                'tax_amount',
                'warehouse_location',
                'batch_no',
                'created_by_id'
            ]);
        });
    }
};
