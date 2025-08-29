<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddBusinessesTable extends Migration
{
    public function up()
    {
        Schema::create('add_businesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('legal_name');
            $table->string('business_type')->nullable();
            $table->string('industry_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
