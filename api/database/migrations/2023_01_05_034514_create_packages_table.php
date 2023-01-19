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
        Schema::create('packages', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('weight',50)->nullable()->default(null);
            $table->string('length',50)->nullable()->default(null);
            $table->string('width',50)->nullable()->default(null);
            $table->string('height',50)->nullable()->default(null);
            $table->string('price',50)->nullable()->default(null);
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
        Schema::dropIfExists('packages');
    }
};
