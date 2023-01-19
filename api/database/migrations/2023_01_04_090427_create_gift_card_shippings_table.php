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
        Schema::create('gift_card_shippings', function (Blueprint $table) {
            $table->id();
            $table->string('name',250)->nullable();
            $table->string('slug',250)->nullable();
            $table->string('mobile',15)->nullable();
            $table->string('email',50)->nullable();
            $table->tinyInteger('active')->nullable();
            $table->text('remember_token')->nullable();
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
        Schema::dropIfExists('gift_card_shippings');
    }
};
