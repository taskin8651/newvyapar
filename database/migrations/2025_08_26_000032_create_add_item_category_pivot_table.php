<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddItemCategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('add_item_category', function (Blueprint $table) {
            $table->unsignedBigInteger('add_item_id');
            $table->foreign('add_item_id', 'add_item_id_fk_10696735')->references('id')->on('add_items')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id', 'category_id_fk_10696735')->references('id')->on('categories')->onDelete('cascade');
        });
    }
}
