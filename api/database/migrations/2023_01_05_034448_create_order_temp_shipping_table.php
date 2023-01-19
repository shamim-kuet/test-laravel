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
        Schema::create('order_temp_shipping', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('cust_id')->nullable()->default(null);
            $table->integer('business_id')->nullable()->default(null);
            $table->integer('pro_id')->nullable()->default(null);
            $table->integer('ship_id')->nullable()->default(null);
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
        Schema::dropIfExists('order_temp_shipping');
    }
};
