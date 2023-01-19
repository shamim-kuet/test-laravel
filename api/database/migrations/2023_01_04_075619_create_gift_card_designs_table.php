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
        Schema::create('gift_card_designs', function (Blueprint $table) {
            $table->id();		
            $table->integer('delivery_type')->nullable();
            $table->integer('format')->nullable();
            $table->integer('theme')->nullable();
            $table->string('design',250)->nullable();
            $table->string('slug',250)->nullable();
            $table->string('files',250)->nullable();
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
        Schema::dropIfExists('gift_card_designs');
    }
};
