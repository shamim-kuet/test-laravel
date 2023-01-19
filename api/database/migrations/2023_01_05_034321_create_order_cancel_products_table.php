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
        Schema::create('order_cancel_products', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('cancel_id')->default(0);
            $table->integer('order_details_id')->default(0);
            $table->integer('order_id')->default(0);
            $table->integer('guest_id')->nullable()->default(null);
            $table->integer('customer_id')->default(0);
            $table->integer('business_id')->nullable()->default(null);
            $table->integer('seller_id')->default(0);
            $table->string('status',100)->nullable()->default(null);
            $table->integer('refunded')->nullable()->default(null);
            $table->string('table_name',150)->nullable()->default(null);
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
        Schema::dropIfExists('order_cancel_products');
    }
};
