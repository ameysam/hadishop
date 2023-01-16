<?php

namespace App\Models;

use App\Traits\Room\RoomAccessorTrait;
use App\Traits\Room\RoomMethodTrait;
use App\Traits\Room\RoomRelationTrait;
use App\Traits\Room\RoomScopeTrait;

class Room extends Model
{
    use RoomRelationTrait,
        RoomAccessorTrait,
        RoomMethodTrait,
        RoomScopeTrait;
}
