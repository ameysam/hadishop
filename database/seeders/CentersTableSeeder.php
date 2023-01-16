<?php

namespace Database\Seeders;

use App\Constants\Types\Center\CenterStatusType;
use App\Constants\Types\Room\RoomStatusType;
use App\Constants\Types\Room\RoomType;
use App\Models\Center;
use App\Models\CenterType;
use Illuminate\Database\Seeder;

class CentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type1 = CenterType::create([
            'name' => 'نوع ۱',
        ]);
        $type2 = CenterType::create([
            'name' => 'نوع ۲',
        ]);

        $center1 = Center::create([
            'name' => 'مرکز ۱',
            'status' => CenterStatusType::CENTER_STATUS_ACTIVE,
            'address' => 'توضیحات مرکز ۱',
            'type_id' => $type1->id,
        ]);

        $center1->rooms()->create([
            'name' => 'اتاق جلسات ۱',
            'type' => RoomType::ROOM_MEETINGS,
            'status' => RoomStatusType::ROOM_STATUS_ACTIVE,
        ]);

        $center1->rooms()->create([
            'name' => 'اتاق ۱',
            'type' => RoomType::ROOM_NORMAL,
            'status' => RoomStatusType::ROOM_STATUS_ACTIVE,
        ]);

        $center2 = Center::create([
            'name' => 'مرکز ۲',
            'status' => CenterStatusType::CENTER_STATUS_ACTIVE,
            'address' => 'توضیحات مرکز ۲',
            'type_id' => $type1->id,
        ]);

        $center2->rooms()->create([
            'name' => 'اتاق جلسات ۲',
            'type' => RoomType::ROOM_MEETINGS,
            'status' => RoomStatusType::ROOM_STATUS_ACTIVE,
        ]);

        $center2->rooms()->create([
            'name' => 'اتاق جلسات ۳',
            'type' => RoomType::ROOM_MEETINGS,
            'status' => RoomStatusType::ROOM_STATUS_ACTIVE,
        ]);

        $center2->rooms()->create([
            'name' => 'اتاق جلسات ۴',
            'type' => RoomType::ROOM_MEETINGS,
            'status' => RoomStatusType::ROOM_STATUS_ACTIVE,
        ]);

        $center3 = Center::create([
            'name' => 'مرکز ۳',
            'status' => CenterStatusType::CENTER_STATUS_ACTIVE,
            'address' => 'توضیحات مرکز ۳',
            'type_id' => $type2->id,
        ]);

        $center3->rooms()->create([
            'name' => 'اتاق ۲',
            'type' => RoomType::ROOM_NORMAL,
            'status' => RoomStatusType::ROOM_STATUS_ACTIVE,
        ]);
    }
}
