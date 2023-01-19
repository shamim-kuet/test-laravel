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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('postby',150)->nullable();
            $table->string('publishdate',150)->nullable();
            $table->text('name',150)->nullable();
            $table->text('slug',150)->nullable();
            $table->longText('details')->nullable();
            $table->string('image',250)->nullable();
            $table->string('file',250)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('sequence')->default(0);
            $table->text('meta_description')->nullable();
            $table->text('keywords')->nullable();
            $table->date('entry_date')->nullable();
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
        Schema::dropIfExists('news');
    }
};
