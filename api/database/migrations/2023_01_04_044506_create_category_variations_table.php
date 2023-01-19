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
        Schema::create('category_variations', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('category_id')->nullable()->default(null);
            $table->string('variation',250)->nullable()->default(null);
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
        Schema::dropIfExists('category_variations');
    }
};
