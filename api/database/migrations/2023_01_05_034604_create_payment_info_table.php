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
        Schema::create('payment_info', function (Blueprint $table) {
            $table->integer('id',10)->unsigned();
            $table->integer('customer_id');
            $table->integer('business_id')->nullable()->default(null);
            $table->string('payment_method')->nullable()->default(null);
            $table->string('accountname',250)->nullable()->default(null);
            $table->string('accountemail',250)->nullable()->default(null);
            $table->string('card_name',250)->nullable()->default(null);
            $table->string('card_number',150)->nullable()->default(null);
            $table->string('cvc',50)->nullable()->default(null);
            $table->integer('exp_month')->nullable()->default(null);
            $table->integer('exp_year')->nullable()->default(null);
            $table->tinyInteger('defaults')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_info');
    }
};
