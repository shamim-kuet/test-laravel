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
        Schema::create('product_variation_details', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('parent_id');
            $table->integer('product_id')->nullable()->default(null);
            $table->string('sku',50)->nullable()->default(null);
            $table->string('var_code',50)->nullable()->default(null);
            $table->string('var_product_id_type',50)->nullable()->default(null);
            $table->integer('var_id');
            $table->string('variation1',150)->nullable()->default(null);
            $table->string('variation2',150)->nullable()->default(null);
            $table->string('variation1Val',100)->nullable()->default(null);
            $table->string('variation2Val',100)->nullable()->default(null);
            $table->string('conditions',100)->nullable()->default(null);
            $table->text('condition_note')->nullable();
            $table->integer('quantity')->nullable()->default(null);
            $table->string('price',50)->nullable()->default(null);
            $table->string('manufacturer_part_number',250)->nullable()->default(null);
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
        Schema::dropIfExists('product_variation_details');
    }
};
