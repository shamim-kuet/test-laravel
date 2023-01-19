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
        Schema::create('marchents', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('name',250)->nullable()->default(null);
            $table->string('businessname',250)->nullable()->default(null);
            $table->string('username',250)->nullable()->default(null);
            $table->string('ownername',100)->nullable()->default(null);
            $table->string('photo',200)->nullable()->default(null);
            $table->string('logo',250)->nullable()->default(null);
            $table->text('address')->nullable();
            $table->text('address2')->nullable();
            $table->integer('country')->nullable()->default(null);
            $table->string('city',250)->nullable()->default(null);
            $table->string('state',250)->nullable()->default(null);
            $table->string('zipcode',250)->nullable()->default(null);
            $table->string('language',250)->nullable()->default(null);
            $table->string('telephone',15)->nullable()->default(null);
            $table->string('mobile',15)->nullable()->default(null);
            $table->string('email',50)->nullable()->default(null);
            $table->string('alternate_email',100)->nullable()->default(null);
            $table->string('password',200)->nullable()->default(null);
            $table->string('passwordHints',60)->nullable()->default(null);
            $table->string('website',50)->nullable()->default(null);
            $table->tinyInteger('otpverify')->default(0);
            $table->tinyInteger('agreement_complete')->default(0);
            $table->tinyInteger('business_complete')->default(0);
            $table->tinyInteger('payment_complete')->default(0);
            $table->tinyInteger('active')->nullable()->default(null);
            $table->string('member_type',150)->nullable()->default(null);
            $table->integer('default_tax_code')->nullable()->default(null);
            $table->tinyInteger('agrrement')->default(1);
            $table->text('remember_token')->nullable();
            $table->integer('store_preset')->nullable()->default(null);
            $table->string('licence',250)->nullable()->default(null);
            $table->string('tin',250)->nullable()->default(null);
            $table->string('category',250)->nullable()->default(null);
            $table->string('organization',250)->nullable()->default(null);
            $table->string('business',250)->nullable()->default(null);
            $table->string('accounttype',150)->nullable()->default(null);
            $table->string('partnertype',150)->nullable()->default(null);
            $table->string('reference_id',50)->nullable()->default(null);
            $table->integer('created_by')->unsigned()->nullable()->default(null);
            $table->integer('updated_by')->unsigned()->nullable()->default(null);
            $table->integer('deleted_by')->unsigned()->nullable()->default(null);
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
        Schema::dropIfExists('marchents');
    }
};
