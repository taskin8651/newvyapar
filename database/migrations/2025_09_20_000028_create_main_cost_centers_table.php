<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainCostCentersTable extends Migration
{
    public function up()
    {
        Schema::create('main_cost_centers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cost_center_name');
            $table->string('unique_code')->nullable();
            $table->longText('details_of_cost_center')->nullable();
            $table->longText('location')->nullable();
            $table->decimal('budget_amount', 15, 2)->nullable();
            $table->decimal('actual_amount', 15, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
