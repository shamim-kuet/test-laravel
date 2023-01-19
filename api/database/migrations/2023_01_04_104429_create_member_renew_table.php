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
        Schema::create('member_renew', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('doc_id',50)->nullable()->default(null);
            $table->string('memberName',150)->nullable()->default(null);
            $table->string('member_type',60)->nullable()->default(null);
            $table->date('from_date')->nullable()->default(null);
            $table->date('to_date')->nullable()->default(null);
            $table->string('price',30)->nullable()->default(null);
            $table->string('pmathod',50)->nullable()->default(null);
            $table->string('transitionId',30)->nullable()->default(null);
            $table->string('receiveBy',100)->nullable()->default(null);
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
        Schema::dropIfExists('member_renew');
    }
};
