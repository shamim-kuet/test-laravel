<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BannerSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
