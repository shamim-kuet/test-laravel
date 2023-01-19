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
        Schema::create('order_return_requests', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('order_no',50)->nullable()->default(null);
            $table->integer('order_id');
            $table->integer('guest_id')->nullable()->default(null);
            $table->integer('customer_id');
            $table->integer('business_id')->nullable()->default(null);
            $table->integer('order_details_id')->nullable()->default(null);
            $table->integer('order_product_id')->nullable()->default(null);
            $table->string('return_type',50)->nullable()->default(null);
            $table->integer('exchangeproduct')->nullable()->default(null);
            $table->string('return_causes',250)->nullable()->default(null);
            $table->text('remarks')->nullable();
            $table->string('status',50);
            $table->integer('refunded')->nullable()->default(null);
            $table->string('table_name',150)->nullable()->default(null);
            $table->string('paymentmethod',50)->nullable()->default(null);
            $table->string('account_name',150)->nullable()->default(null);
            $table->string('account_number',150)->nullable()->default(null);
            $table->string('total_amount',100)->nullable()->default(null);
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
        Schema::dropIfExists('order_return_requests');
    }
};
