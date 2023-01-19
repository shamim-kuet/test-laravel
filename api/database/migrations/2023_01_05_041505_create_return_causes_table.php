<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('return_causes', function (Blueprint $table) {
            $table->id();
            $table->string('title',250)->nullable();
            $table->timestamps();
        });
        
        DB::statement('ALTER TABLE `return_causes` ADD `details` VARBINARY(16)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `return_causes` DROP COLUMN `details`');
        Schema::dropIfExists('return_causes');
    }
};
