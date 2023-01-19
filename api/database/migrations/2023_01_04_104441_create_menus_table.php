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
        Schema::create('menus', function (Blueprint $table) {
            $table->integer('id',10)->unsigned();
            $table->string('menu_type',50)->nullable()->default(null);
            $table->integer('country_id');
            $table->integer('parent_id')->nullable()->default(null);
            $table->string('title',100);
            $table->string('uri',100)->nullable()->default(null);
            $table->integer('sequence');
            $table->integer('status')->unsigned()->default(1);
            $table->string('type',50)->nullable()->default(null);
            $table->text('urls')->nullable();
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
        Schema::dropIfExists('menus');
    }
};
