<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account_name');
            $table->string('opening_balance');
            $table->date('as_of_date')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('upi')->nullable();
            $table->boolean('print_upi_qr')->default(0)->nullable();
            $table->boolean('print_bank_details')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
