<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMainCostCentersTable extends Migration
{
    public function up()
    {
        Schema::table('main_cost_centers', function (Blueprint $table) {
            $table->unsignedBigInteger('link_with_company_id')->nullable();
            $table->foreign('link_with_company_id', 'link_with_company_fk_10720191')->references('id')->on('add_businesses');
            $table->unsignedBigInteger('responsible_manager_id')->nullable();
            $table->foreign('responsible_manager_id', 'responsible_manager_fk_10720192')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10720201')->references('id')->on('users');
        });
    }
}
