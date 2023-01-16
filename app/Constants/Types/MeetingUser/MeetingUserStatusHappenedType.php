<?php


namespace App\Constants\Types\MeetingUser;

use App\Constants\Types\Type;


class MeetingUserStatusHappenedType extends Type
{
    /* نامشخص */
    const MEETING_USER_STATUS_HAPPENED_DEFAULT = 1;

    /* شرکت کرده */
    const MEETING_USER_STATUS_HAPPENED_PARTICIPATED = 2;
    
    /* شرکت نکرده */
    const MEETING_USER_STATUS_HAPPENED_DID_NOT_PARTICIPATE = 3;
}
