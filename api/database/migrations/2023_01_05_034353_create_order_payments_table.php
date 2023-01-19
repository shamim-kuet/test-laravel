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
        Schema::create('order_payments', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('customer_id')->nullable()->default(null);
            $table->integer('guest_id')->nullable()->default(null);
            $table->integer('business_id')->nullable()->default(null);
            $table->integer('shipping_id')->nullable()->default(null);
            $table->integer('order_id')->nullable()->default(null);
            $table->integer('seller_id')->nullable()->default(null);
            $table->string('before_tax',50)->nullable()->default(null);
            $table->string('estimate_tax',50)->nullable()->default(null);
            $table->string('gift_value',50)->nullable()->default(null);
            $table->string('total_amount',50)->nullable()->default(null);
            $table->string('paid_amount',50)->nullable()->default(null);
            $table->float('due_amount')->nullable()->default(null);
            $table->string('discount',50)->nullable()->default(null);
            $table->string('payment_method',100)->nullable()->default(null);
            $table->string('customer_identifier',250)->nullable()->default(null);
            $table->string('charge_id',250)->nullable()->default(null);
            $table->string('mobile_banking_id',50)->nullable()->default(null);
            $table->string('transition_id',50)->nullable()->default(null);
            $table->text('paypal_pay_id')->nullable();
            $table->text('paypal_sale_id')->nullable();
            $table->string('card_name',250)->nullable()->default(null);
            $table->string('card_number',100)->nullable()->default(null);
            $table->string('cvc',100)->nullable()->default(null);
            $table->string('month',50)->nullable()->default(null);
            $table->integer('year')->nullable()->default(null);
            $table->float('shipping_charge')->nullable()->default(null);
            $table->string('status',100)->nullable()->default(null);
            $table->text('remarks')->nullable();
            $table->string('ship_date',100)->nullable()->default(null);
            $table->string('delivery_date',150)->nullable()->default(null);
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
        Schema::dropIfExists('order_payments');
    }
};
