<?php


namespace App\Traits\Meeting;

use App\Constants\Types\Meeting\MeetingHoldingStatusType;
use App\Constants\Types\Meeting\MeetingStatusType;

trait MeetingAccessorTrait
{
    public function getStatusFaAttribute()
    {
        $result = null;
        if($this->status)
        {
            $result = MeetingStatusType::getValue($this->status);
        }

        return $result;
    }

    public function getHoldingStatusFaAttribute()
    {
        $result = null;
        if($this->holding_status)
        {
            $result = MeetingHoldingStatusType::getValue($this->holding_status);
        }

        return $result;
    }
}
