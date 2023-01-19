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
        Schema::create('seller_fbes', function (Blueprint $table) {
            $table->id();
            $table->string('seller_id',50)->nullable();
            $table->string('contract_type',150)->nullable();
            $table->string('contract_duration',60)->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->string('charge',30)->nullable();
            $table->string('currency',50)->nullable();
            $table->string('chargefor',50)->nullable();
            $table->string('particulars',40)->nullable();
            $table->string('status',50)->nullable();
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
        Schema::dropIfExists('seller_fbes');
    }
};
