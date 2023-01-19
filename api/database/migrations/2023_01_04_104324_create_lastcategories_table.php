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
        Schema::create('lastcategories', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('cat_id')->nullable()->default(null);
            $table->integer('subcat_id')->nullable()->default(null);
            $table->string('name',250)->nullable()->default(null);
            $table->string('slug',250)->nullable()->default(null);
            $table->text('details')->nullable();
            $table->string('seotitle',200)->nullable()->default(null);
            $table->string('keywords',250)->nullable()->default(null);
            $table->string('thumb',250)->nullable()->default(null);
            $table->string('banner',250)->nullable()->default(null);
            $table->integer('sequence')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(null);
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
        Schema::dropIfExists('lastcategories');
    }
};
