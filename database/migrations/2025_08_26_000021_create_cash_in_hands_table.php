<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashInHandsTable extends Migration
{
    public function up()
    {
        Schema::create('cash_in_hands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('adjustment');
            $table->decimal('enter_amount', 15, 2);
            $table->date('adjustment_date')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
