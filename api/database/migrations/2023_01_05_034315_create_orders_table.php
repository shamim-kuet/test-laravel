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
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('country')->nullable()->default(null);
            $table->string('seller_id',50)->nullable()->default(null);
            $table->integer('customer_id')->nullable()->default(null);
            $table->integer('guest_id')->nullable()->default(null);
            $table->integer('business_id')->nullable()->default(null);
            $table->integer('business_group_id')->nullable()->default(null);
            $table->integer('shipping_id');
            $table->string('order_number',30)->nullable()->default(null);
            $table->float('total_price')->nullable()->default(null);
            $table->string('temp_status',50)->nullable()->default(null);
            $table->string('status',100)->nullable()->default(null);
            $table->date('order_date')->nullable()->default(null);
            $table->string('ship_date',50)->nullable()->default(null);
            $table->string('delivery_date',100)->nullable()->default(null);
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
        Schema::dropIfExists('orders');
    }
};
