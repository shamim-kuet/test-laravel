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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id')->nullable();
            $table->string('fullname',250)->nullable();
            $table->string('contact',50)->nullable();
            $table->string('email',250)->nullable();
            $table->text('address')->nullable();
            $table->string('apartment',50)->nullable();
            $table->string('country',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('area',100)->nullable();
            $table->string('zipcode',50)->nullable();
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
        Schema::dropIfExists('guests');
    }
};
