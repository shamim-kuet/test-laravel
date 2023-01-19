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
        Schema::create('product_inventory', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('product_id');
            $table->integer('initial_qty')->default(0);
            $table->double('unit_price')->nullable()->default(null);
            $table->double('market_price')->nullable()->default(null);
            $table->float('purchase_price')->default(0);
            $table->float('sell_price')->default(0);
            $table->double('discount')->nullable()->default(0);
            $table->string('discount_type',50)->nullable()->default(null);
            $table->string('discount_amount',50)->nullable()->default(null);
            $table->integer('stock_qty')->default(0);
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
        Schema::dropIfExists('product_inventories');
    }
};
