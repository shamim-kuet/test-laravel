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
        Schema::create('promotions', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('seller_id');
            $table->string('promotion_type',150)->nullable()->default(null);
            $table->string('buyer_purchase',150)->nullable()->default(null);
            $table->integer('min_quantity');
            $table->string('buyer_get',150)->nullable()->default(null);
            $table->integer('product_selection');
            $table->text('descripton')->nullable();
            $table->string('trackingid',150)->nullable()->default(null);
            $table->string('shipping_templates',150)->nullable()->default(null);
            $table->timestamp('start_date')->nullable()->default(null);
            $table->timestamp('end_date')->nullable()->default(null);
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
        Schema::dropIfExists('promotions');
    }
};
