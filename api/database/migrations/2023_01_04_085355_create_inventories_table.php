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
        Schema::create('inventories', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('seller_id')->default(0);
            $table->integer('product_id')->default(0);
            $table->integer('initial_qty')->default(0);
            $table->integer('increment_qty')->default(0);
            $table->integer('decrement_qty')->default(0);
            $table->integer('current_qty')->default(0);
            $table->float('initial_price')->default(0);
            $table->float('purchase_price')->default(0);
            $table->float('sell_price')->default(0);
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
        Schema::dropIfExists('inventories');
    }
};
