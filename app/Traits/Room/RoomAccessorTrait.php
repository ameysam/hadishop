<?php


namespace App\Traits\Room;

use App\Constants\Types\Room\RoomStatusType;
use App\Constants\Types\Room\RoomType;

/**
 * Trait RoomAccessorTrait
 */
trait RoomAccessorTrait
{
    
    public function getTypeFaAttribute()
    {
        $result = null;
        if($this->type)
        {
            $result = RoomType::getValue($this->type);
        }

        return $result;
    }
    
    public function getStatusFaAttribute()
    {
        $result = null;
        if($this->status)
        {
            $result = RoomStatusType::getValue($this->status);
        }

        return $result;
    }
}
