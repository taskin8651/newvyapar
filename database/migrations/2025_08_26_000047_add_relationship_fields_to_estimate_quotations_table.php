<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEstimateQuotationsTable extends Migration
{
    public function up()
    {
        Schema::table('estimate_quotations', function (Blueprint $table) {
            $table->unsignedBigInteger('select_customer_id')->nullable();
            $table->foreign('select_customer_id', 'select_customer_fk_10696822')->references('id')->on('party_details');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10696838')->references('id')->on('users');
        });
    }
}
