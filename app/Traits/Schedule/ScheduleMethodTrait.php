<?php

namespace App\Traits\Schedule;

use App\Constants\Types\Schedule\ScheduleStatusType;

trait ScheduleMethodTrait
{
    public function isActive()
    {
        return $this->type == ScheduleStatusType::SCHEDULE_STATUS_ACTIVE;
    }
}
