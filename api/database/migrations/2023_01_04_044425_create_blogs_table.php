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
        Schema::create('blogs', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('country')->nullable()->default(null);
            $table->integer('userid');
            $table->integer('category')->nullable()->default(null);
            $table->string('headline',250)->nullable()->default(null);
            $table->string('slug',250)->nullable()->default(null);
            $table->string('video',50)->nullable()->default(null);
            $table->longText('description')->nullable();
            $table->string('image',250)->nullable()->default(null);
            $table->string('postby',150)->nullable()->default(null);
            $table->string('publishdate',50)->nullable()->default(null);
            $table->integer('read_count')->default(0);
            $table->integer('sequence')->nullable()->default(null);
            $table->integer('hotblog')->nullable()->default(null);
            $table->tinyInteger('active')->default(0);
            $table->string('meta_description',250)->nullable()->default(null);
            $table->string('keywords',250)->nullable()->default(null);
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
        Schema::dropIfExists('blogs');
    }
};
