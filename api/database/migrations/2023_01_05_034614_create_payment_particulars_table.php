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
        Schema::create('payment_particulars', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('particular',150)->nullable()->default(null);
            $table->string('amount',50)->nullable()->default(null);
            $table->string('duration',150)->nullable()->default(null);
            $table->integer('sequence')->nullable()->default(null);
            $table->integer('status')->nullable()->default(null);
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
        Schema::dropIfExists('payment_particulars');
    }
};
