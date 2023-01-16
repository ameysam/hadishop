<?php

namespace Database\Seeders;

use App\Models\Chart;
use Illuminate\Database\Seeder;

class ChartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chart::create([
            'center_id' => 1,
            'parent_id' => null,
            'post_id' => 1,
            'user_id' => 1,
            'level' => 1,
        ]);
        Chart::create([
            'center_id' => 1,
            'parent_id' => 1,
            'post_id' => 2,
            'user_id' => 2,
            'level' => 2,
        ]);
        Chart::create([
            'center_id' => 1,
            'parent_id' => 2,
            'post_id' => 3,
            'user_id' => 2,
            'level' => 3,
        ]);
        Chart::create([
            'center_id' => 1,
            'parent_id' => null,
            'post_id' => 4,
            'user_id' => 1,
            'level' => 1,
        ]);
    }
}
