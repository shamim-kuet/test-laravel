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
        Schema::create('payment_requests', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('user_id')->nullable()->default(null);
            $table->string('current_balance',50)->nullable()->default(null);
            $table->decimal('amount',10,0)->nullable()->default(null);
            $table->string('request_method',50)->nullable()->default(null);
            $table->string('accounts',150)->nullable()->default(null);
            $table->decimal('paid_amount',10,0)->nullable()->default(null);
            $table->date('paid_date')->nullable()->default(null);
            $table->string('status',100)->nullable()->default(null);
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
        Schema::dropIfExists('payment_requests');
    }
};
