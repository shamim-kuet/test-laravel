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
        Schema::create('gifts', function (Blueprint $table) {
            $table->id();		
            $table->integer('customer_id');
            $table->integer('guest_id')->nullable();
            $table->integer('business_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->integer('product_id');
            $table->string('giftitem',150)->nullable();
            $table->integer('gift');
            $table->float('price')->nullable();
            $table->text('message')->nullable();
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
        Schema::dropIfExists('gifts');
    }
};
