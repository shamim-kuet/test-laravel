<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        for ($i=0; $i < 15 ; $i++) {
            $category = Category::create([
                'type'       => $i % 2 === 0 ? 'highlighted' : 'top-rated',
                'country_id' => $i,
                'name'       => 'category' . $i,
                'alternate'  => 'lorem' .$i * 2,
                'slug'       => 'category-' . $i,
                'seo_title'  => 'categories',
                'details'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ',
                'image'      => $i % 2 === 0 ? 'https://efranchiseprac.s3.amazonaws.com/photos/profile_pic/2023/01/17/bag.png' : 'https://efranchiseprac.s3.amazonaws.com/photos/profile_pic/2023/01/17/01.png',
                'status'     => 1,
            ]);
            for ($j=0; $j < 6 ; $j++) {
                $sub_category = Subcategory::create([
                    'type'        => $j % 2 === 0 ? 'highlighted' : 'top-rated',
                    'category_id' => $category['id'],
                    'name'        => 'sub category' . $j,
                    'slug'        => 'sub-category-' . $j,
                    'image'      => 'https://efranchiseprac.s3.amazonaws.com/photos/profile_pic/2023/01/17/06.png',
                    'status'      => 1,
                ]);
                for ($k=0; $k < 5 ; $k++) {
                    SubSubcategory::create([
                        'category_id'     => $category['id'],
                        'sub_category_id' => $sub_category['id'],
                        'name'            => 'sub-sub-category' . $k,
                        'slug'            => 'sub-sub-category-' . $k,
                        'status'          => 1,
                    ]);
                }
            }
        }
    }
}
