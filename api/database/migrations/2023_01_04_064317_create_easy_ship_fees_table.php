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
        Schema::create('easy_ship_fees', function (Blueprint $table) {
            $table->id();
            $table->string('weight_type',150)->nullable();
            $table->string('weight_label',150)->nullable();
            $table->integer('local');
            $table->integer('regional');
            $table->integer('national');
            $table->integer('international');
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
        Schema::dropIfExists('easy_ship_fees');
    }
};
