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
        Schema::create('inventory_histories', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('seller_id');
            $table->integer('product_id')->default(0);
            $table->integer('qty')->default(0);
            $table->float('purchase_price')->default(0);
            $table->float('sell_price')->default(0);
            $table->text('remark')->nullable();
            $table->date('date')->nullable()->default(null);
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
        Schema::dropIfExists('inventory_histories');
    }
};
