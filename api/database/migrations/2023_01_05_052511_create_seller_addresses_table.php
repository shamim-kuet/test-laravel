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
        Schema::create('seller_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id');
            $table->string('contact',50)->nullable();
            $table->text('address')->nullable();
            $table->text('address2')->nullable();
            $table->string('country',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('zipcode',50)->nullable();
            $table->integer('set_as_default')->nullable();
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
        Schema::dropIfExists('seller_addresses');
    }
};
