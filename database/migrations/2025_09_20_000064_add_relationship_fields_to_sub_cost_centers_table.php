<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubCostCentersTable extends Migration
{
    public function up()
    {
        Schema::table('sub_cost_centers', function (Blueprint $table) {
            $table->unsignedBigInteger('main_cost_center_id')->nullable();
            $table->foreign('main_cost_center_id', 'main_cost_center_fk_10720203')->references('id')->on('main_cost_centers');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10720215')->references('id')->on('users');
        });
    }
}
