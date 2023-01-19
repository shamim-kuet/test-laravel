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
        Schema::create('settings', function (Blueprint $table) {
            $table->bigInteger('id',20)->unsigned();
            $table->string('site_name')->nullable()->default(null);
            $table->string('site_title')->nullable()->default(null);
            $table->string('logo')->nullable()->default(null);
            $table->string('default_image')->nullable()->default(null);
            $table->string('copyright_message')->nullable()->default(null);
            $table->string('copyright_name')->nullable()->default(null);
            $table->string('copyright_url')->nullable()->default(null);
            $table->longText('design_develop_by_text')->nullable()->default(null);
            $table->longText('design_develop_by_name')->nullable()->default(null);
            $table->longText('design_develop_by_url')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('website_link')->nullable()->default(null);
            $table->string('default_url')->nullable()->default(null);
            $table->string('api_url')->nullable()->default(null);
            $table->string('fav_icon')->nullable()->default(null);
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
        Schema::dropIfExists('settings');
    }
};
