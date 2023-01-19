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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name',250)->nullable();
            $table->string('sign',50)->nullable();
            $table->string('shortform',50)->nullable();
            $table->float('value')->nullable();
            $table->text('countries')->nullable();
            $table->integer('country')->default(0)->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->tinyInteger('display')->default(0)->nullable();
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
        Schema::dropIfExists('currencies');
    }
};
