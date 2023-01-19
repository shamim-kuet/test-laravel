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
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('country_id')->nullable()->default(null);
            $table->string('type',150)->nullable()->default(null);
            $table->string('name',250)->nullable()->default(null);
            $table->string('alternate',250)->nullable()->default(null);
            $table->string('slug',250)->nullable()->default(null);
            $table->string('seo_title',200)->nullable()->default(null);
            $table->string('details',250)->nullable()->default(null);
            $table->string('keywords',250)->nullable()->default(null);
            $table->string('icon',250)->nullable()->default(null);
            $table->string('banner',250)->nullable()->default(null);
            $table->string('image',250)->nullable()->default(null);
            $table->integer('sequence')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(null);
            $table->integer('main_menu')->nullable();
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
        Schema::dropIfExists('categories');
    }
};
