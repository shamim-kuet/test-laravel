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
        Schema::create('schedule_pickups', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id');
            $table->integer('order_id');
            $table->string('order_no',50)->nullable();
            $table->date('order_date')->nullable();
            $table->string('pickup_date',50)->nullable();
            $table->string('shipping_method',100)->nullable();
            $table->string('pickup_time',100)->nullable();
            $table->string('total_charge',250)->nullable();
            $table->string('weight',100)->nullable();
            $table->string('dimen_length',50)->nullable();
            $table->string('dimen_width',50)->nullable();
            $table->string('dimen_height',50)->nullable();
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
        Schema::dropIfExists('schedule_pickups');
    }
};
