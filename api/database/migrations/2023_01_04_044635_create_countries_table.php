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
        Schema::create('countries', function (Blueprint $table) {
            $table->mediumInteger('id',100)->unsigned();
            $table->string('name',100);
            $table->string('iso2',2);
            $table->char('iso3',3)->nullable()->default(null);
            $table->string('capital')->nullable()->default(null);
            $table->string('currency')->nullable()->default(null);
            $table->tinyInteger('flag')->default(1);
            $table->string('phone_code',5);
            $table->string('wiki_data_id')->nullable()->default(null);
            $table->string('region');
            $table->string('sub_region');
            $table->tinyInteger('defaults')->default(0);
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('countries');
    }
};
