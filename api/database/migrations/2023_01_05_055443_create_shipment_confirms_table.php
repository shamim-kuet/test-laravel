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
        Schema::create('shipment_confirms', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id');
            $table->integer('order_id');
            $table->string('order_no',50)->nullable();
            $table->date('order_date')->nullable();
            $table->string('ship_date',50)->nullable();
            $table->string('shipping_method',100)->nullable();
            $table->string('courier',100)->nullable();
            $table->string('shipping_service',250)->nullable();
            $table->string('tracking_id',100)->nullable();
            $table->text('hyperlinks')->nullable();
            $table->string('status',100)->nullable();
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
        Schema::dropIfExists('shipment_confirms');
    }
};
