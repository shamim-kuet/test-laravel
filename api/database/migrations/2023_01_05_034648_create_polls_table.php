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
        Schema::create('polls', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('postby',150)->nullable()->default(null);
            $table->text('name')->nullable()->default(null);
            $table->text('slug')->nullable()->default(null);
            $table->tinyInteger('status')->default(0);
            $table->text('meta_description')->nullable();
            $table->text('keywords')->nullable();
            $table->date('entry_date')->nullable()->default(null);
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
        Schema::dropIfExists('polls');
    }
};
