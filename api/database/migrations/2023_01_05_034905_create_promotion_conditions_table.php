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
        Schema::create('promotion_conditions', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('seller_id');
            $table->integer('promotion_id');
            $table->string('userBuy',50)->nullable()->default(null);
            $table->string('userGet',50)->nullable()->default(null);
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
        Schema::dropIfExists('promotion_conditions');
    }
};
