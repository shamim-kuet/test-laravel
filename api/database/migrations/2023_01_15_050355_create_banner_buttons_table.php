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
        Schema::create('banner_buttons', function (Blueprint $table) {
            $table->id();
            $table->integer('banner_id');
            $table->string('name')->nullable();
            $table->string('route_link')->nullable();
            $table->string('color')->nullable();
            $table->string('bg_color')->nullable();
            $table->integer('sequence')->default(0);
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
        Schema::dropIfExists('banner_buttons');
    }
};
