<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPurchaseBillsTable extends Migration
{
    public function up()
    {
        Schema::table('purchase_bills', function (Blueprint $table) {
            $table->unsignedBigInteger('select_customer_id')->nullable();
            $table->foreign('select_customer_id', 'select_customer_fk_10697029')->references('id')->on('party_details');
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->foreign('payment_type_id', 'payment_type_fk_10697043')->references('id')->on('bank_accounts');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10697047')->references('id')->on('users');
        });
    }
}
