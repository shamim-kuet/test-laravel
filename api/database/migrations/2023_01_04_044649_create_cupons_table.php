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
        Schema::create('cupons', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('cname',200)->nullable()->default(null);
            $table->string('code',50)->nullable()->default(null);
            $table->string('price',50)->nullable()->default(null);
            $table->decimal('discount',10,0)->nullable()->default(null);
            $table->string('dis_type',10)->nullable()->default(null);
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
        Schema::dropIfExists('cupons');
    }
};
