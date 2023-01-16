<?php


namespace App\Traits\Event;

use App\Constants\Types\Event\EventStatusType;

trait EventAccessorTrait
{
    public function getStatusFaAttribute()
    {
        $result = null;
        if($this->status)
        {
            $result = EventStatusType::getValue($this->status);
        }

        return $result;
    }
}
