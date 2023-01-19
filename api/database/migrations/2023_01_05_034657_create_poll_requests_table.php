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
        Schema::create('poll_requests', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('seller_id');
            $table->integer('poll_id');
            $table->string('status',250)->nullable()->default(null);
            $table->text('message')->nullable();
            $table->date('date')->nullable()->default(null);
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
        Schema::dropIfExists('poll_requests');
    }
};
