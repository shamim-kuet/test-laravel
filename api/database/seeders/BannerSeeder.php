<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\BannerButtons;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::truncate();
        for ($i = 0; $i < 2 ; $i++) {
            $banner = Banner::create([
                'heading'            => 'Banner '. $i,
                'meta_details'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ',
                'image'              => 'image/path/image-name.png',
                'alignment'          => $i % 2 === 0 ? 'center' : 'left',
                'banner_route_link'  => 'https://this-is-a-empty-link/',
                'keywords'           => 'this,is,new,key,words',
                'sequence'           => $i,
                'status'             => 1,
            ]);
            for ($j = 0; $j < 3 ; $j++) {
                BannerButtons::create([
                    'banner_id'  => $banner->id,
                    'name'       => 'Banner Button '. $j,
                    'route_link' => 'https://this-is-a-empty-link/',
                    'color'      => '#468158',
                    'bg_color'   => '#468158',
                    'sequence'   => $j
                ]);
            }
        }

        for ($i = 0; $i < 3 ; $i++) {
            $banner = Banner::create([
                'heading'            => 'Banner '. $i,
                'meta_details'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ',
                'image'              => 'image/path/image-name.png',
                'alignment'          => $i % 2 === 0 ? 'right' : 'left',
                'banner_route_link'  => 'https://this-is-a-empty-link/',
                'keywords'           => 'this,is,new,key,words',
                'sequence'           => $i,
                'status'             => 1,
            ]);
            for ($j = 0; $j < 3 ; $j++) {
                BannerButtons::create([
                    'banner_id'  => $banner->id,
                    'name'       => 'Banner Button '. $j,
                    'route_link' => 'https://this-is-a-empty-link/',
                    'color'      => '#468158',
                    'bg_color'   => '#468158',
                    'sequence'   => $j
                ]);
            }
        }
    }
}
