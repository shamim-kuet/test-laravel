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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('fullname',250)->nullable();
            $table->string('contact',50)->nullable();
            $table->text('address')->nullable();
            $table->string('country',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('area',100)->nullable();
            $table->string('zipcode',50)->nullable();
            $table->integer('set_as_default')->nullable();
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
        Schema::dropIfExists('customer_addresses');
    }
};
