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
        Schema::create('mailboxes', function (Blueprint $table) {
            $table->integer('id',11);
            $table->integer('userid');
            $table->string('subject',250)->nullable()->default(null);
            $table->string('tomail',50)->nullable()->default(null);
            $table->string('slug',250)->nullable()->default(null);
            $table->mediumText('description')->nullable();
            $table->integer('read_count')->default('0');
            $table->tinyInteger('active')->default('0');
            $table->string('mailtype',50)->nullable()->default(null);
            $table->string('sender_type',50)->nullable()->default(null);
            $table->string('receiver_type',50)->nullable()->default(null);
            $table->string('status',50)->nullable()->default(null);
            $table->string('token',250)->nullable()->default(null);
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
        Schema::dropIfExists('mailboxes');
    }
};
