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
        Schema::create('sponcer', function (Blueprint $table) {
            $table->id();
            $table->string('image',100)->nullable();
            $table->string('sponcer_name',50)->nullable();
            $table->tinyInteger('exclusive_sponcer')->nullable();
            $table->tinyInteger('local_sponcer')->nullable();
            $table->integer('sequence')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('date_time',100)->nullable();
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
        Schema::dropIfExists('sponcer');
    }
};
