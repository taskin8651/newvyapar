<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBankToCashesTable extends Migration
{
    public function up()
    {
        Schema::table('bank_to_cashes', function (Blueprint $table) {
            $table->unsignedBigInteger('from_id')->nullable();
            $table->foreign('from_id', 'from_fk_10696971')->references('id')->on('bank_accounts');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10696980')->references('id')->on('users');
        });
    }
}
