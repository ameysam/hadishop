<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliders = [
            [
                'name' => 'اسلایدر تستی اول',
                'link' => 'https://www.google.com',
            ],
            [
                'name' => 'اسلایدر تستی دوم',
                'link' => 'https://www.google.com',
            ],
        ];

        foreach($sliders as $slider){
            Slider::create($slider);
        }
    }
}
