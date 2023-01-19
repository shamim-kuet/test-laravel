<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\SubSubcategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        $sub_sub_categories = SubSubcategory::where('category_id', 1)->take(5)->get();
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('sub_category_id', 2)->take(2)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('category_id', 2)->take(5)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('sub_category_id', 7)->take(2)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('category_id', 3)->take(5)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('sub_category_id', 13)->take(2)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('category_id', 4)->take(5)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('sub_category_id', 19)->take(2)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('category_id', 5)->take(5)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('sub_category_id', 25)->take(2)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('category_id', 6)->take(5)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('category_id', 7)->take(5)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('category_id', 8)->take(5)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('category_id', 9)->take(5)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('category_id', 10)->take(5)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('category_id', 11)->take(5)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('category_id', 12)->take(5)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('category_id', 13)->take(5)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('category_id', 14)->take(5)->get());
        $sub_sub_categories = $sub_sub_categories->merge(SubSubcategory::where('category_id', 15)->take(5)->get());
        foreach ($sub_sub_categories as $key => $sub_sub_category) {
            for ($i = 0; $i < 2 ; $i++) {
                $product = Product::create([
                    'city_id'             => 1,
                    'state_id'            => 1,
                    'country_id'          => 1,
                    'seller_id'           => 1,
                    'category_id'         => $sub_sub_category['category_id'],
                    'sub_category_id'     => $sub_sub_category['sub_category_id'],
                    'sub_sub_category_id' => $sub_sub_category['id'],
                    'name'                => 'product '.$key. $i,
                    'slug'                => 'product-'.$key. $i,
                    'code'                => 'product-code-'.$key. $i,
                    'avg_ratings'         => rand(1, 50) / 10,
                    'product_type'        => 'product type',
                    'main_image'          => 'https://efranchiseprac.s3.amazonaws.com/photos/profile_pic/2023/01/17/16.png',
                    'recent_arrival'      => $key < 10 ? 1 : 0,
                    'top_deal'            => $key < 5 ? 1 : 0,
                    'status'              => 1,
                ]);
                ProductInventory::create([
                    'product_id'      => $product->id,
                    'initial_qty'     => 10,
                    'unit_price'      => 90,
                    'market_price'    => 95,
                    'purchase_price'  => 75,
                    'sell_price'      => 90,
                    'discount'        => 5,
                    'discount_type'   => 'flush_sale',
                    'discount_amount' => 85,
                    'stock_qty'       => 8,
                ]);
            }
        }
    }
}
