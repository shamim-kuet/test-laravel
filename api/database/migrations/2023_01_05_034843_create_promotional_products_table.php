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
        Schema::create('promotional_products', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('seller_id');
            $table->string('selection_type',150)->nullable()->default(null);
            $table->string('trackingid',250)->nullable()->default(null);
            $table->text('details')->nullable()->default(null);
            $table->longText('products_instance')->nullable()->default(null);
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
        Schema::dropIfExists('promotional_products');
    }
};
