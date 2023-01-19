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
        Schema::create('return_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->integer('order_details_id');
            $table->integer('customer_id')->nullable();
            $table->integer('business_id')->nullable();
            $table->integer('return_id')->default(0);
            $table->integer('parent_invoice')->default(0);
            $table->integer('invoice_number')->nullable();
            $table->date('invoice_date')->nullable();
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
        Schema::dropIfExists('return_invoices');
    }
};
