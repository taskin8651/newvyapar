<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAddItemsTable extends Migration
{
    public function up()
    {
        Schema::table('add_items', function (Blueprint $table) {
            $table->unsignedBigInteger('select_unit_id')->nullable();
            $table->foreign('select_unit_id', 'select_unit_fk_10696693')->references('id')->on('units');
            $table->unsignedBigInteger('select_tax_id')->nullable();
            $table->foreign('select_tax_id', 'select_tax_fk_10696776')->references('id')->on('tax_rates');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10696677')->references('id')->on('users');
        });
    }
}
