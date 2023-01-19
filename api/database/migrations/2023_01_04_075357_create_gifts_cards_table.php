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
        Schema::create('gifts_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('delivery_type');
            $table->integer('format')->nullable();
            $table->integer('theme')->nullable();
            $table->integer('feature_brand')->nullable();
            $table->integer('category')->nullable();
            $table->integer('occasion_id');
            $table->integer('sub_occasion_id');
            $table->integer('seller_id')->nullable();
            $table->string('pricetype',50)->nullable();
            $table->integer('product_id')->nullable();
    
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
        Schema::dropIfExists('gifts_cards');
    }
};
