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
                'name' => 'کامپیوتر و لپ تاپ', //6
                'file' => '/assets/front/1.png',
            ],
            [
                'name' => 'دوربین دیجیتال', //5
                'file' => '/assets/front/2.png',
            ],
            [
                'name' => 'گوشی هوشمند', //4
                'file' => '/assets/front/3_002.png',
            ],
            [
                'name' => 'تلویزیون', //3
                'file' => '/assets/front/4.png',
            ],
            [
                'name' => 'لوازم صوتی', //2
                'file' => '/assets/front/5_002.png',
            ],
            [
                'name' => 'ساعت هوشمند', //‍1
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
            [
                'category_id' => 2,
                'name' => 'هندزفری بی سیم',
                'description' => 'هندزفری بی سیم',
                'price' => 1990000,
                'file' => 'assets/front/product-6.jpg',
            ],
            [
                'category_id' => 2,
                'name' => 'دستگاه ایکس باکس وان',
                'description' => 'دستگاه ایکس باکس وان',
                'price' => 2698500,
                'file' => 'assets/front/product-7.jpg',
            ],
            [
                'category_id' => 1,
                'name' => 'ساعت اپل - سری 4 جنس صفحه آلمینیومی',
                'description' => 'ساعت اپل - سری 4 جنس صفحه آلمینیومی',
                'price' => 4993650,
                'file' => 'assets/front/product-8.jpg',
            ],
            [
                'category_id' => 4,
                'name' => 'آیپد اپل - سایز 11 اینچ - 256 گیگ',
                'description' => 'آیپد اپل - سایز 11 اینچ - 256 گیگ',
                'price' => 9658000,
                'file' => 'assets/front/product-3.jpg',
            ],
            [
                'category_id' => 2,
                'name' => 'هدفون وایرلس بیتس',
                'description' => 'هدفون وایرلس بیتس',
                'price' => 1254000,
                'file' => 'assets/front/product-10.jpg',
                'special' => 1,
                'suggest' => 1,
            ],
            [
                'category_id' => 5,
                'name' => 'دوربین عکاسی 360 درجه ضد آب',
                'description' => 'دوربین عکاسی 360 درجه ضد آب',
                'price' => 3254000,
                'file' => 'assets/front/product-11.jpg',
                'suggest' => 1,
            ],
            [
                'category_id' => 1,
                'name' => 'ساعت اپل - با بند سفید اسپورت',
                'description' => 'ساعت اپل - با بند سفید اسپورت',
                'price' => 54710000,
                'file' => 'assets/front/product-12.jpg',
                'suggest' => 1
            ],
            [
                'category_id' => 6,
                'name' => 'لپ تاپ لنوو - 15.6 اینچ',
                'description' => 'لپ تاپ لنوو - 15.6 اینچ',
                'price' => 1800000,
                'file' => 'assets/front/product-13.jpg',
                'suggest' => 1
            ],
            [
                'category_id' => 5,
                'name' => 'دوربین سونی - آلفا 5100',
                'description' => 'دوربین سونی - آلفا 5100',
                'price' => 6520000,
                'file' => 'assets/front/product-14.jpg',
                'suggest' => 1
            ],
            [
                'category_id' => 2,
                'name' => 'اسپیکر هوشمند کوچک',
                'description' => 'اسپیکر هوشمند کوچک',
                'price' => 111000,
                'file' => 'assets/front/product-15.jpg',
                'suggest' => 1
            ],
            [
                'category_id' => 2,
                'name' => 'اسپیکر بلوتوث قابل حمل',
                'description' => 'اسپیکر بلوتوث قابل حمل',
                'price' => 3325000,
                'file' => 'assets/front/product-16.jpg',
                'suggest' => 1
            ],
            [
                'category_id' => 3,
                'name' => 'قطب نمای گوگل',
                'description' => 'قطب نمای گوگل',
                'price' => 146500,
                'file' => 'assets/front/product-17.jpg',
                'suggest' => 1,
                'special' => 1,
            ],
        ];


        $counter = 0;
        foreach($products as $record){
            $file = $record['file'];
            $record['available'] = $counter % 5 == 0 ? 0 : 1;
            $record['visit_count'] = rand(10, 50);
            $counter++;
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
