<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_payment_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id')->nullable();
            $table->string('payment_method',50)->nullable();
            $table->string('cardname',250)->nullable();
            $table->string('cardno',100)->nullable();
            $table->integer('exp_month')->nullable();
            $table->integer('exp_year')->nullable();
            $table->integer('cvc')->nullable();
            $table->string('amount',50)->nullable();
            $table->integer('address')->nullable();
            $table->string('bank_name')->nullable();
            $table->integer('bank_country')->nullable();
            $table->string('bank_account_name',250)->nullable();
            $table->string('bank_account_number',150)->nullable();
            $table->string('routing',150)->nullable();
            $table->string('paypalinfo',200)->nullable();
            $table->string('status',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_payment_infos');
    }
};
