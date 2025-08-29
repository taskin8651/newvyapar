<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCurrentStocksTable extends Migration
{
    public function up()
    {
        Schema::table('current_stocks', function (Blueprint $table) {
            $table->unsignedBigInteger('parties_id')->nullable();
            $table->foreign('parties_id', 'parties_fk_10697369')->references('id')->on('party_details');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10697375')->references('id')->on('users');
        });
    }
}
