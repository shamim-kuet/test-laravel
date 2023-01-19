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
        Schema::create('gift_card_types', function (Blueprint $table) {
            $table->id();
            $table->integer('country');
            $table->string('name',150)->nullable();
            $table->string('slug',150)->nullable();
            $table->string('type',150)->nullable();
            $table->text('description')->nullable();
            $table->string('image',150)->nullable();
            $table->integer('sequence');
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
        Schema::dropIfExists('gift_card_types');
    }
};
