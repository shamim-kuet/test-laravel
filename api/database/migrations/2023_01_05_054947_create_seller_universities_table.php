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
        Schema::create('seller_universities', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id')->nullable();
            $table->integer('subcat_id')->nullable();
            $table->string('title',191)->nullable();
            $table->string('slug',250)->nullable();
            $table->string('cover',250)->nullable();
            $table->string('media_type',150)->nullable();
            $table->string('file',250)->nullable();
            $table->string('youtube',150)->nullable();
            $table->date('date')->nullable();
            $table->string('view',250)->nullable();
            $table->text('content')->nullable();
            $table->string('content_type',100)->default('Lessons, Courses');
            $table->integer('sequence')->nullable();
            $table->string('active',50)->nullable();
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
        Schema::dropIfExists('seller_universities');
    }
};
