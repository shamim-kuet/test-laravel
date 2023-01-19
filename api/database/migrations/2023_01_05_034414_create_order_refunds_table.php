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
        Schema::create('order_refunds', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('order_details_id')->default('0');
            $table->integer('order_id')->default('0');
            $table->integer('return_from_id');
            $table->string('table_name',50)->nullable()->default(null);
            $table->string('total_amount',50)->nullable()->default(null);
            $table->string('refund_amount',50)->nullable()->default(null);
            $table->string('refund_status',100)->nullable()->default(null);
            $table->string('refund_token',250)->nullable()->default(null);
            $table->string('refund_from',100)->nullable()->default(null);
            $table->string('charge_id',250)->nullable()->default(null);
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
        Schema::dropIfExists('order_refunds');
    }
};
