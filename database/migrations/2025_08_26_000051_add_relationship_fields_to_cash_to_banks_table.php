<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCashToBanksTable extends Migration
{
    public function up()
    {
        Schema::table('cash_to_banks', function (Blueprint $table) {
            $table->unsignedBigInteger('to_id')->nullable();
            $table->foreign('to_id', 'to_fk_10696987')->references('id')->on('bank_accounts');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10696995')->references('id')->on('users');
        });
    }
}
