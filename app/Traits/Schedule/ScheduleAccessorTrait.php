<?php


namespace App\Traits\Schedule;

use App\Constants\Types\Schedule\ScheduleStatusType;

trait ScheduleAccessorTrait
{
    public function getStatusFaAttribute()
    {
        $result = null;
        if($this->status)
        {
            $result = ScheduleStatusType::getValue($this->status);
        }

        return $result;
    }
}
