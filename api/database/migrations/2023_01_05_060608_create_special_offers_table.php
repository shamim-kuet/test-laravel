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
        Schema::create('special_offers', function (Blueprint $table) {
            $table->id();
            $table->string('url',250)->nullable();
            $table->string('slug',250)->nullable();
            $table->string('name',250)->nullable();
            $table->string('image',250)->nullable();
            $table->text('meta_details')->nullable();
            $table->string('keywords',250)->nullable();
            $table->integer('sequence')->default(0);
            $table->tinyInteger('status')->default(0);
    
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
        Schema::dropIfExists('special_offers');
    }
};
