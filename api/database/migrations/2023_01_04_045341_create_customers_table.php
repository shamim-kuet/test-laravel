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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('seller_id',11)->nullable();
            $table->string('fullname',250)->nullable();
            $table->string('contact',50)->nullable();
            $table->string('username',50)->nullable();
            $table->string('email',250)->nullable();
            $table->text('address')->nullable();
            $table->string('country',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('area',100)->nullable();
            $table->string('zipcode',50)->nullable();
            $table->string('type',100)->nullable();
            $table->string('active',10)->nullable();
            $table->string('photo',250)->nullable();
            $table->text('password')->nullable();
            $table->string('password_hints',100)->nullable();
            $table->text('remember_token')->nullable();
            $table->string('provider',250)->nullable();
            $table->string('provider_id',250)->nullable();
            $table->string('device',250)->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('token',250)->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
