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
        Schema::create('banners', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('heading',250)->nullable()->default(null);
            $table->text('meta_details')->nullable();
            $table->string('image',250)->nullable()->default(null);
            $table->string('alignment',25)->nullable()->comment('left or center or right')->default('center');
            $table->string('banner_route_link',250)->nullable()->default(null);
            $table->string('keywords',250)->nullable()->default(null);
            $table->integer('sequence')->default(0);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('banners');
    }
};
