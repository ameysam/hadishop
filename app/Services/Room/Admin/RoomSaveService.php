<?php

namespace App\Services\Room\Admin;

use App\Constants\Types\Center\CenterStatusType;
use App\Constants\Types\Room\RoomStatusType;
use App\Models\Center;
use App\Models\CenterType;
use App\Models\Room;
use App\Services\Role\Admin\RoleService;
use App\Services\User\Admin\UserService;

class RoomSaveService
{
    private $center;

    private $record;


    public function setCenter(Center $center)
    {
        $this->center = $center;
        return $this;
    }

    public function setRecord(Room $record)
    {
        $this->record = $record;
        return $this;
    }


    public function getRecord()
    {
        return $this->record;
    }


    public function save($request)
    {
        if(!$this->record)
        {
            $this->record = new Room();
        }

        $this->record->name = $request['name'];

        $this->record->type = $request['type'];

        $this->record->status = $request['status'] ?? RoomStatusType::ROOM_STATUS_ACTIVE;

        $this->record->description = $request['description'];
        
        $this->record->schedule_id = $request['schedule_id'] ?? null;

        $this->record->capacity = $request['capacity'] ?? 1;

        $this->record->center_id = $this->center->id;

        $this->record->save();

        return $this->record;
    }
}
