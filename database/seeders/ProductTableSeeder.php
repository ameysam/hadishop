<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'خانه و آشپزخانه',
            'صوتی و تصویری',
            'گجت',
        ];

        foreach($categories as $category){
            Category::create(['name' => $category]);
        }




        $products = [
            [
                'category_id' => rand(1, count($categories)),
                'name' => 'لیاسشویی بوش',
                'image' => '',
                'description' => 'این کالا خیلی خفن و خوبه',
                'price' => 12000000,
            ],
            [
                'category_id' => rand(1, count($categories)),
                'name' => 'لیاسشویی سامسونگ',
                'image' => '',
                'description' => 'این کالا خیلی خفن و خوبه',
                'price' => 2500000,
            ],
            [
                'category_id' => rand(1, count($categories)),
                'name' => 'یخچال دوو',
                'image' => '',
                'description' => 'این کالا خیلی خفن و خوبه',
                'price' => 3600000,
            ],
        ];


        foreach($products as $record){
            Product::create($record);
        }
    }
}
