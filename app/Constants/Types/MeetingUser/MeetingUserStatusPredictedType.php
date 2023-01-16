<?php


namespace App\Constants\Types\MeetingUser;

use App\Constants\Types\Type;


class MeetingUserStatusPredictedType extends Type
{
    /* نامشخص */
    const MEETING_USER_STATUS_PREDICTED_DEFAULT = 1;

    /* شرکت میکنم */
    const MEETING_USER_STATUS_PREDICTED_I_PARTICIPATE = 2;
    
    /* شرکت نمیکنم */
    const MEETING_USER_STATUS_PREDICTED_I_DONT_PARTICIPATE = 3;
    
    /* شاید شرکت کنم */
    const MEETING_USER_STATUS_PREDICTED_MAYBE_I_PARTICIPATE = 4;
}
