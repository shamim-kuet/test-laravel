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
        Schema::create('gift_purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->integer('order_details_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('customer_type',50)->nullable();
            $table->string('card_price',50)->nullable();
            $table->string('card_value',50)->nullable();
            $table->string('gift_promo_code',192)->nullable();
            $table->string('design',250)->nullable();
            $table->string('design_type',250)->nullable();
            $table->integer('status')->nullable();
            $table->string('already_use',192)->nullable();
            $table->timestamp('used_date')->nullable();
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
        Schema::dropIfExists('gift_purchases');
    }
};
