<?php

namespace Database\Seeders;

use App\Constants\Types\File\FileReasonType;
use App\Constants\Types\File\FileVisibilityType;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Services\File\Src\FileSaveService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.p
     *
     * @return void
     */
    public function run()
    {
        $categories = array_reverse([
            [
                'name' => 'کامپیوتر و لپ تاپ',
                'file' => '/assets/front/1.png',
            ],
            [
                'name' => 'دوربین دیجیتال',
                'file' => '/assets/front/2.png',
            ],
            [
                'name' => 'گوشی هوشمند',
                'file' => '/assets/front/3_002.png',
            ],
            [
                'name' => 'تلویزیون',
                'file' => '/assets/front/4.png',
            ],
            [
                'name' => 'لوازم صوتی',
                'file' => '/assets/front/5_002.png',
            ],
            [
                'name' => 'ساعت هوشمند',
                'file' => '/assets/front/6.png',
            ],
        ]);

        $user = User::first();

        foreach($categories as $category){
            $fileSaveService = new FileSaveService();

            $category_record = Category::create(['name' => $category['name']]);

            $files = Storage::disk('public_folder')->get($category['file']);
            $fileSaveService
                ->setDestination('public')
                ->setFileableRecord($category_record)
                ->setUser($user)
                ->setUploader($user)
                ->setReasonType(FileReasonType::FILE_REASON_LOGO)
                ->setVisibilityType(FileVisibilityType::FILE_VISIBILITY_PUBLIC)
                ->save($files);
        }


        $products = [
            [
                'category_id' => 6,
                'name' => 'لپ تاپ مک بوک پرو - 13 اینچ',
                'description' => 'لپ تاپ مک بوک پرو - 13 اینچ',
                'price' => 1199000,
                'file' => 'assets/front/product-1_002.jpg',
            ],
            [
                'category_id' => 6,
                'name' => 'لپ تاپ مک بوک پرو - 15 اینچ',
                'description' => 'لپ تاپ مک بوک پرو - 15 اینچ',
                'price' => 1288000,
                'file' => 'assets/front/product-1_002.jpg',
            ],
            [
                'category_id' => 4,
                'name' => 'آیپد پرو اپل - سایز 11 اینچ - حافظه 256 گیگ',
                'description' => 'آیپد پرو اپل - سایز 11 اینچ - حافظه 256 گیگ',
                'price' => 2500000,
                'file' => 'assets/front/product-3.jpg',
            ],
            [
                'category_id' => 3,
                'name' => 'تلویزیون ال ای دی سامسونگ - سایز 55 اینچ',
                'description' => 'تلویزیون ال ای دی سامسونگ - سایز 55 اینچ',
                'price' => 42597000,
                'file' => 'assets/front/product-5.jpg',
            ],
            [
                'category_id' => 4,
                'name' => 'گوشی گوشی گوگل مدل پیکسل 3 - 128 گیگابایت',
                'description' => 'گوشی گوشی گوگل مدل پیکسل 3 - 128 گیگابایت',
                'price' => 1865000,
                'file' => 'assets/front/product-4.jpg',
            ],
            [
                'category_id' => 5,
                'name' => 'اسپیکر بلوتوث',
                'description' => 'اسپیکر بلوتوث',
                'price' => 365000,
                'file' => 'assets/front/product-2.jpg',
            ],
        ];


        foreach($products as $record){
            $file = $record['file'];
            unset($record['file']);
            $product = Product::create($record);
            $files = Storage::disk('public_folder')->get($file);
            $fileSaveService = new FileSaveService();
            $fileSaveService
                ->setDestination('public')
                ->setFileableRecord($product)
                ->setUser($user)
                ->setUploader($user)
                ->setReasonType(FileReasonType::FILE_REASON_LOGO)
                ->setVisibilityType(FileVisibilityType::FILE_VISIBILITY_PUBLIC)
                ->save($files);
        }
    }
}
