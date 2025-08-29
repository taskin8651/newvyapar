<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddBusinessUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('add_business_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_10697376')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('add_business_id');
            $table->foreign('add_business_id', 'add_business_id_fk_10697376')->references('id')->on('add_businesses')->onDelete('cascade');
        });
    }
}
