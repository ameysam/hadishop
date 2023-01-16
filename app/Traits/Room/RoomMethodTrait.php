<?php

namespace App\Traits\Room;

use App\Constants\Types\Room\RoomType;

/**
 * Trait RoomMethodTrait
 */
trait RoomMethodTrait
{
    
    public function isMeetings()
    {
        return $this->type == RoomType::ROOM_MEETINGS;
    }
}
