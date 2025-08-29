<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartyDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('party_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('party_name');
            $table->string('gstin')->unique();
            $table->string('phone_number')->unique();
            $table->string('pan_number')->nullable();
            $table->string('place_of_supply')->nullable();
            $table->string('type_of_supply')->nullable();
            $table->string('gst_type')->nullable();
            $table->string('pincode')->unique();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->longText('billing_address')->nullable();
            $table->longText('shipping_address')->nullable();
            $table->string('email')->nullable();
            $table->decimal('opening_balance', 15, 2);
            $table->date('as_of_date')->nullable();
            $table->string('opening_balance_type')->nullable();
            $table->string('credit_limit');
            $table->decimal('credit_limit_amount', 15, 2)->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->longText('notes')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
