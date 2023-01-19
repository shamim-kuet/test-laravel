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
        Schema::create('gift_card_sellers', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('name',250)->nullable()->default(null);
            $table->string('slug',250)->nullable()->default(null);
            $table->string('mobile',15)->nullable()->default(null);
            $table->string('email',50)->nullable()->default(null);
            $table->tinyInteger('active')->nullable()->default(null);
            $table->text('remember_token')->nullable();
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
        Schema::dropIfExists('gift_card_sellers');
    }
};
