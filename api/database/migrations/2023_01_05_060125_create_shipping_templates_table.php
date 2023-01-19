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
        Schema::create('shipping_templates', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id')->nullable();
            $table->string('name',250)->nullable();
            $table->string('transit_time',250)->nullable();
            $table->string('type',250)->default('Per item/weight banded, price bandedm');
            $table->string('country',200)->nullable();
            $table->string('city',200)->nullable();
            $table->text('areas')->nullable();
            $table->integer('shipping_rate');
            $table->integer('selection')->nullable();
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
        Schema::dropIfExists('shipping_templates');
    }
};
