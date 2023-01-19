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
        Schema::create('states', function (Blueprint $table) {
            $table->id()->index();
            $table->mediumInteger('country_id')->index();
            $table->string('name');
            $table->char('country_code');
            $table->string('fips_code')->nullable();
            $table->string('iso2')->nullable();
            $table->tinyInteger('defaults')->default(0);
            $table->tinyInteger('flag')->default(1);
            $table->string('wiki_data_id')->nullable();
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
        Schema::dropIfExists('states');
    }
};
