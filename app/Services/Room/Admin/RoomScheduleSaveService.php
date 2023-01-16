<?php

namespace App\Services\Room\Admin;

use App\Constants\Types\Center\CenterStatusType;
use App\Constants\Types\Room\RoomStatusType;
use App\Models\Center;
use App\Models\CenterType;
use App\Models\Room;
use App\Services\Role\Admin\RoleService;
use App\Services\User\Admin\UserService;

class RoomScheduleSaveService
{
    public function setRoom(Room $value)
    {
        $this->room = $value;
        return $this;
    }

    public function save($schedule_id = null)
    {
        $this->room->schedule_id = $schedule_id;

        $this->room->save();

        return $this->room;
    }
}
