<?php


namespace App\Constants\Types\Meeting;

use App\Constants\Types\Type;


class MeetingHoldingStatusType extends Type
{
    /* در انتظار برگزاری */
    const MEETING_HOLDING_STATUS_WAITING_FOR_START = 1;
    
    /* در حال برگزاری */
    const MEETING_HOLDING_STATUS_ON_PERFORMING = 2;

    /* خاتمه یافته */
    const MEETING_HOLDING_STATUS_TERMINATED = 3;
    
    /* برگزار نشده */
    const MEETING_HOLDING_STATUS_NOT_HELD = 4;
}
