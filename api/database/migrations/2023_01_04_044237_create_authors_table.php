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
        Schema::create('authors', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('name',250)->nullable()->default(null);
            $table->longText('biography')->nullable();
            $table->string('author_name',192)->nullable()->default(null);
            $table->string('photo',200)->nullable()->default(null);
            $table->text('address')->nullable();
            $table->text('address2')->nullable();
            $table->string('country',192)->nullable()->default(null);
            $table->string('city',250)->nullable()->default(null);
            $table->string('state',250)->nullable()->default(null);
            $table->string('zipcode',250)->nullable()->default(null);
            $table->string('telephone',50)->nullable()->default(null);
            $table->string('mobile',15)->nullable()->default(null);
            $table->string('email',50)->nullable()->default(null);
            $table->string('alternate_email',100)->nullable()->default(null);
            $table->string('password',200)->nullable()->default(null);
            $table->string('passwordHints',60)->nullable()->default(null);
            $table->string('website',50)->nullable()->default(null);
            $table->tinyInteger('active')->nullable()->default(null);
            $table->string('otpverify',192)->nullable()->default(null);
            $table->string('agrrement',192)->nullable()->default(null);
            $table->string('member_type',150)->nullable()->default(null);
            $table->text('language')->nullable();
            $table->integer('default_tax_code')->nullable()->default(null);
            $table->text('remember_token')->nullable();
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
        Schema::dropIfExists('authors');
    }
};
