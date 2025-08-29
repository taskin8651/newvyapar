<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBankToBanksTable extends Migration
{
    public function up()
    {
        Schema::table('bank_to_banks', function (Blueprint $table) {
            $table->unsignedBigInteger('from_id')->nullable();
            $table->foreign('from_id', 'from_fk_10696997')->references('id')->on('bank_accounts');
            $table->unsignedBigInteger('to_id')->nullable();
            $table->foreign('to_id', 'to_fk_10696998')->references('id')->on('bank_accounts');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10697006')->references('id')->on('users');
        });
    }
}
