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
        Schema::create('mail_replies', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('mailid');
            $table->string('tomail',50)->nullable()->default(null);
            $table->mediumText('description')->nullable();
            $table->string('sender_type',50)->nullable()->default(null);
            $table->string('receiver_type',50)->nullable()->default(null);
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
        Schema::dropIfExists('mail_replies');
    }
};
