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
        Schema::create('project_countries', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('name',200)->nullable()->default(null);
            $table->string('shortform',50)->nullable()->default(null);
            $table->string('code',50)->nullable()->default(null);
            $table->string('flag',250)->nullable()->default(null);
            $table->string('continents',250)->nullable()->default(null);
            $table->string('domain',150)->nullable()->default(null);
            $table->integer('defaults')->nullable()->default(null);
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
        Schema::dropIfExists('project_countries');
    }
};
