<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPaymentOutsTable extends Migration
{
    public function up()
    {
        Schema::table('payment_outs', function (Blueprint $table) {
            $table->unsignedBigInteger('parties_id')->nullable();
            $table->foreign('parties_id', 'parties_fk_10697475')->references('id')->on('party_details');
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->foreign('payment_type_id', 'payment_type_fk_10697476')->references('id')->on('bank_accounts');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10697487')->references('id')->on('users');
        });
    }
}
