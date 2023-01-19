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
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id',11)->index();
            $table->integer('city_id')->nullable()->default(null)->index();
            $table->integer('state_id')->nullable()->default(null)->index();
            $table->integer('country_id')->nullable()->default(null)->index();
            $table->integer('seller_id')->nullable()->default(null)->index();
            $table->integer('category_id')->nullable()->default(null)->index();
            $table->integer('sub_category_id')->nullable()->default(null)->index();
            $table->integer('sub_sub_category_id')->nullable()->default(null)->index();
            $table->integer('parent_id')->nullable()->default(null)->index();

            $table->string('product_type',50)->nullable()->default(null);
            $table->string('gift_card',100)->nullable()->default(null);
            $table->integer('min_qty')->default(0);
            $table->text('name')->nullable()->default(null);
            $table->text('slug')->nullable()->default(null);
            $table->string('main_image',250)->nullable()->default(null);
            $table->string('caption',250)->nullable()->default(null);
            $table->string('code',50)->nullable()->default(null);
            $table->integer('product_tax_code')->nullable()->default(null);
            $table->string('product_id_type',20)->nullable()->default(null);
            $table->string('sku',150)->nullable()->default(null)->index();
            $table->string('conditions',50)->nullable()->default(null);
            $table->string('brand',150)->nullable()->default(null);
            $table->string('manufacturer',250)->nullable()->default(null);
            $table->string('manufacturer_part_number',250)->nullable()->default(null);
            $table->string('area_of_origin',192)->nullable()->default(null);
            $table->text('features')->nullable();
            $table->text('details')->nullable();
            $table->text('shipping_details')->nullable();
            $table->string('sizes',250)->nullable()->default(null);
            $table->string('colors',250)->nullable()->default(null);
            $table->string('comparable',50)->default(0);
            $table->string('compareItems',100)->nullable()->default(null);
            $table->integer('read_count')->default(0);
            $table->float('avg_ratings')->nullable()->default(null);
            $table->string('item_weight',50)->nullable()->default(null);
            $table->string('item_weight_unit',50)->nullable()->default(null);
            $table->string('package_weight',50)->nullable()->default(null);
            $table->string('package_weight_unit',50)->nullable()->default(null);
            $table->string('dimensions_length',50)->nullable()->default(null);
            $table->string('dimensions_width',50)->nullable()->default(null);
            $table->string('dimensions_height',50)->nullable()->default(null);
            $table->string('warranty',50)->nullable()->default(null);
            $table->string('warranty_type',50)->nullable()->default(null);
            $table->string('warranty_duration',50)->nullable()->default(null);
            $table->string('package_dimension_length',50)->nullable()->default(null);
            $table->string('package_dimension_width',50)->nullable()->default(null);
            $table->string('package_dimension_height',50)->nullable()->default(null);
            $table->string('key_target_audience',250)->nullable()->default(null);
            $table->string('key_attributes',250)->nullable()->default(null);
            $table->string('key_platinum_keywords',250)->nullable()->default(null);
            $table->text('meta_description')->nullable();
            $table->text('keywords')->nullable();
            $table->string('tag',192)->nullable()->default(null);
            $table->string('image_alt',250)->nullable()->default(null);
            $table->string('hreflang_alt',250)->nullable()->default(null);
            $table->string('hreflang_can',250)->nullable()->default(null);
            $table->integer('gift_receipt')->nullable()->default(null);
            $table->integer('gift_wrapped')->nullable()->default(null);
            $table->string('gift_wrap_name',150)->nullable()->default(null);
            $table->string('wrapping_cost',50)->nullable()->default(null);
            $table->string('ship_by',50)->nullable()->default(null);
            $table->string('fulfill_by',192)->default('Self');
            $table->string('available_shipment',50)->nullable()->default(null);
            $table->string('free_shipping',10)->nullable()->default(null);
            $table->integer('custom_shipping')->nullable()->default(null);
            $table->string('custom_name',50)->nullable()->default(null);
            $table->float('custom_cost')->nullable()->default(null);
            $table->tinyInteger('feature')->nullable()->default(null);
            $table->integer('top_offer')->nullable()->default(null);
            $table->integer('trending_offer')->nullable()->default(null);
            $table->string('entry_type',50)->nullable()->default(null);
            $table->integer('delivery_type')->nullable()->default(null);
            $table->date('entry_date')->nullable()->default(null);
            $table->integer('sequence')->default(0);
            $table->tinyInteger('top_deal')->nullable()->default(null);
            $table->tinyInteger('recent_arrival')->nullable()->default(null);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('products');
    }
};
