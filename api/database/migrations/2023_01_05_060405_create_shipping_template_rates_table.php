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
        Schema::create('shipping_template_rates', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id')->nullable();
            $table->integer('stid');
            $table->integer('min_price')->nullable();
            $table->integer('max_price')->nullable();
            $table->string('unit',150)->nullable();
            $table->float('price')->nullable();
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
        Schema::dropIfExists('shipping_template_rates');
    }
};
