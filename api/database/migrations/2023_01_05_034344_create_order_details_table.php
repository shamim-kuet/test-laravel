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
        Schema::create('order_details', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('order_id')->nullable()->default(null);
            $table->integer('seller_id')->nullable()->default(null);
            $table->integer('customer_id')->nullable()->default(null);
            $table->integer('guest_id')->nullable()->default(null);
            $table->integer('business_id')->nullable()->default(null);
            $table->integer('shipping_id');
            $table->integer('gift_card_shipping_id')->nullable()->default(null);
            $table->integer('product_id')->nullable()->default(null);
            $table->string('qty',50)->nullable()->default(null);
            $table->string('saleprice',50)->nullable()->default(null);
            $table->string('pcolor',100)->nullable()->default(null);
            $table->string('psize',100)->nullable()->default(null);
            $table->double('subtotal')->nullable()->default(null);
            $table->string('shipping_charge',50)->nullable()->default(null);
            $table->float('taxprice')->nullable()->default(null);
            $table->float('giftprice')->nullable()->default(null);
            $table->string('ship_template_id',150)->nullable()->default(null);
            $table->string('shipBy',50)->nullable()->default(null);
            $table->string('status',100)->nullable()->default(null);
            $table->string('customer_identifier',250)->nullable()->default(null);
            $table->string('charge_id',250)->nullable()->default(null);
            $table->string('payment_method',100)->nullable()->default(null);
            $table->text('paypal_pay_id')->nullable()->default(null);
            $table->text('paypal_sale_id')->nullable()->default(null);
            $table->string('token',1200)->nullable()->default(null);
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
        Schema::dropIfExists('order_details');
    }
};
