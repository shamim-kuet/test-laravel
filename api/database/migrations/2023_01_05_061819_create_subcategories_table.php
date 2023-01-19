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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('type',150)->nullable()->default(null);
            $table->integer('category_id');
            $table->string('name',250)->nullable();
            $table->string('slug',250)->nullable();
            $table->text('details')->nullable();
            $table->string('seo_title',200)->nullable();
            $table->string('keywords',250)->nullable();
            $table->string('thumb',250)->nullable();
            $table->string('banner',250)->nullable();
            $table->string('image',250)->nullable()->default(null);
            $table->integer('sequence')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(0);
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
        Schema::dropIfExists('subcategories');
    }
};
