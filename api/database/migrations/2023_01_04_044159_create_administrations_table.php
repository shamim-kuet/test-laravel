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
        Schema::create('administrations', function (Blueprint $table) {
            $table->bigInteger('id',20)->unsigned();
            $table->string('fullname',150)->nullable()->default(null);
            $table->string('contact',100)->nullable()->default(null);
            $table->string('username',100)->nullable()->default(null);
            $table->string('email',150)->nullable()->default(null);
            $table->string('designation',150)->nullable()->default(null);
            $table->string('role',250)->nullable()->default(null);
            $table->text('address')->nullable();
            $table->string('photo',250)->nullable()->default(null);
            $table->text('password')->nullable();
            $table->string('password_hints',100)->nullable()->default(null);
            $table->string('remember_token',100)->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(1);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
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
        Schema::dropIfExists('administrations');
    }
};
