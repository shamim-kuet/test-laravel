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
        Schema::create('others_incomes', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('seller_id')->nullable()->default(null);
            $table->integer('heads')->nullable()->default(null);
            $table->string('amount',50)->nullable()->default(null);
            $table->string('amount_in_word',200)->nullable()->default(null);
            $table->string('received_by',150)->nullable()->default(null);
            $table->text('remarks')->nullable()->default(null);
            $table->string('received_date',150)->nullable()->default(null);
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
        Schema::dropIfExists('others_incomes');
    }
};
