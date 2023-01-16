<?php


namespace App\Constants\Types\Meeting;

use App\Constants\Types\Type;


class MeetingStatusType extends Type
{
    /* فعال */
    const MEETING_STATUS_ACTIVE = 1;

    /* غیرفعال */
    const MEETING_STATUS_INACTIVE = 2;

    /* لغو */
    const MEETING_STATUS_CANCELED = 3;
}
