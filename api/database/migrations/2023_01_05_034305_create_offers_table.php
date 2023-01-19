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
        Schema::create('offers', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('cat_id',150)->nullable()->default(null);
            $table->integer('sub_cat_id')->nullable()->default(null);
            $table->string('url',250)->nullable()->default(null);
            $table->string('name',250)->nullable()->default(null);
            $table->string('image',250)->nullable()->default(null);
            $table->text('meta_details')->nullable();
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
        Schema::dropIfExists('offers');
    }
};
