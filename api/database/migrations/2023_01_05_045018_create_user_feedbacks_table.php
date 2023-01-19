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
        Schema::create('user_feedbacks', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('pagetype',150)->nullable()->default(null);
            $table->string('ipaddress',150)->nullable()->default(null);
            $table->string('rating',100)->nullable()->default(null);
            $table->text('message')->nullable();
            $table->string('country',250)->nullable()->default(null);
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
        Schema::dropIfExists('user_feedbacks');
    }
};
