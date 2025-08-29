<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankToCashesTable extends Migration
{
    public function up()
    {
        Schema::create('bank_to_cashes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('to')->nullable();
            $table->decimal('amount', 15, 2);
            $table->date('adjustment_date')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
