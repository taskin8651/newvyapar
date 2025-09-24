<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCostCentersTable extends Migration
{
    public function up()
    {
        Schema::create('sub_cost_centers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sub_cost_center_name');
            $table->string('unique_code')->nullable();
            $table->longText('details_of_sub_cost_center')->nullable();
            $table->string('responsible_manager');
            $table->string('budget_allocated')->nullable();
            $table->string('actual_expense')->nullable();
            $table->date('start_date')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
