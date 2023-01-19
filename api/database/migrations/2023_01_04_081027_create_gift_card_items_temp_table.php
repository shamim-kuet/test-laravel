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
        Schema::create('gift_card_items_temp', function (Blueprint $table) {
            $table->id();		
            $table->integer('product_id');
            $table->string('delivery_email',192)->nullable();
            $table->string('delivery_from',192)->nullable();
            $table->string('message',192)->nullable();
            $table->string('design',250)->nullable();
            $table->string('custom',250)->nullable();
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
        Schema::dropIfExists('gift_card_items_temp');
    }
};
