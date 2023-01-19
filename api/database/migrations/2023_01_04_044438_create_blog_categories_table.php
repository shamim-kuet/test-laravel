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
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('country')->nullable()->default(null);
            $table->string('name',250)->nullable()->default(null);
            $table->string('slug',250)->nullable()->default(null);
            $table->string('banner',250)->nullable()->default(null);
            $table->string('seotitle',150)->nullable()->default(null);
            $table->string('meta_description',250)->nullable()->default(null);
            $table->string('keywords',250)->nullable()->default(null);
            $table->integer('sequence')->nullable()->default(null);
            $table->tinyInteger('active')->nullable()->default(null);
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
        Schema::dropIfExists('blog_categories');
    }
};
