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
        Schema::create('seller_menus', function (Blueprint $table) {
            $table->id();
            $table->string('country',10)->default(1);
            $table->integer('parent_id')->nullable();
            $table->string('title',100);
            $table->string('uri',100)->nullable();
            $table->integer('sequence');
            $table->integer('status')->unsigned()->default(1);
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
        Schema::dropIfExists('seller_menus');
    }
};
