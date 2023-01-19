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
        Schema::create('product_ratings', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('pro_id')->nullable()->default(null);
            $table->string('username',100)->nullable()->default(null);
            $table->string('email',50)->nullable()->default(null);
            $table->integer('ratval')->nullable()->default(null);
            $table->text('review')->nullable();
            $table->string('review_title',250)->nullable()->default(null);
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
        Schema::dropIfExists('product_ratings');
    }
};
