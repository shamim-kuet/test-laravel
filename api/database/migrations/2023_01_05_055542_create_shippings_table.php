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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('guest_id')->nullable();
            $table->integer('business_id')->nullable();
            $table->string('fullname',250)->nullable();
            $table->string('contact',50)->nullable();
            $table->text('address')->nullable();
            $table->string('state',150)->nullable();
            $table->string('city',150)->nullable();
            $table->string('country',150)->nullable();
            $table->string('zipcode',50)->nullable();
            $table->text('delivery_instruction')->nullable();
            $table->integer('current')->nullable();
            $table->string('type',50)->nullable();
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
        Schema::dropIfExists('shippings');
    }
};
