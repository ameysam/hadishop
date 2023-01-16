<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'name' => 'رئیس هیئت مدیره'
        ]);

        Post::create([
            'name' => 'مدیرعامل'
        ]);

        Post::create([
            'name' => 'عضو هیئت مدیره'
        ]);

        Post::create([
            'name' => 'مدیر فنی'
        ]);

        Post::create([
            'name' => 'مدیر اداری'
        ]);

        Post::create([
            'name' => 'کارمند'
        ]);

        Post::create([
            'name' => 'مسئول خدمات'
        ]);
    }
}
