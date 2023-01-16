<?php


namespace App\Constants\Types\Meeting;

use App\Constants\Types\Type;


class MeetingPeriodicType extends Type
{
    /* غیر دوره‌ای */
    const MEETING_PERIODIC_NON_PERIODIC = 0;

    /* روزانه */
    const MEETING_PERIODIC_DAILY = 1;

    /* هفته‌ای */
    const MEETING_PERIODIC_WEEKLY = 7;

    /* دو هفته‌ای */
    const MEETING_PERIODIC_TWO_WEEKLY = 14;

    /* ماهانه */
    const MEETING_PERIODIC_MONTHLY = 30;
}
