<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentOutsTable extends Migration
{
    public function up()
    {
        Schema::create('payment_outs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->string('reference_no')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('discount')->nullable();
            $table->decimal('total', 15, 2)->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
