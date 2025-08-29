<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAdjustBankBalancesTable extends Migration
{
    public function up()
    {
        Schema::table('adjust_bank_balances', function (Blueprint $table) {
            $table->unsignedBigInteger('from_id')->nullable();
            $table->foreign('from_id', 'from_fk_10697009')->references('id')->on('bank_accounts');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10697018')->references('id')->on('users');
        });
    }
}
