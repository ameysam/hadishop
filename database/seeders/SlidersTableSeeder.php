<?php

namespace Database\Seeders;

use App\Constants\Types\File\FileReasonType;
use App\Constants\Types\File\FileVisibilityType;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Services\File\Src\FileSaveService;
use Illuminate\Support\Facades\Storage;

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
                'name' => 'آیپدهای هوشمند اپل',
                'link' => 'https://www.google.com',
                'file' => 'assets/front/images/slide-1.png',
            ],
            [
                'name' => 'هدفون‌های جدید با کیفیت صوتی بالا',
                'link' => 'https://www.google.com',
                'file' => 'assets/front/images/slide-2.png',
            ],
        ];

        $user = User::first();

        foreach($sliders as $record){

            $file = $record['file'];
            unset($record['file']);
            $slider = Slider::create($record);
            $files = Storage::disk('public_folder')->get($file);
            $fileSaveService = new FileSaveService();
            $fileSaveService
                ->setDestination('public')
                ->setFileableRecord($slider)
                ->setUser($user)
                ->setUploader($user)
                ->setReasonType(FileReasonType::FILE_REASON_LOGO)
                ->setVisibilityType(FileVisibilityType::FILE_VISIBILITY_PUBLIC)
                ->save($files);
        }
    }
}
