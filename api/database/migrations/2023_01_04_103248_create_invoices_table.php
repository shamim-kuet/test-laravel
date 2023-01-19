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
        Schema::create('invoices', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('order_id',50)->nullable()->default(null);
            $table->integer('order_details_id');
            $table->integer('guest_id')->nullable()->default(null);
            $table->integer('customer_id')->nullable()->default(null);
            $table->integer('business_id')->nullable()->default(null);
            $table->string('invoice_number')->nullable()->default(null);
            $table->date('invoice_date')->nullable()->default(null);
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
        Schema::dropIfExists('invoices');
    }
};
