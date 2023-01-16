<?php


namespace App\Constants\Types\Event;

use App\Constants\Types\Type;


class EventPeriodicType extends Type
{
    /* غیر دوره‌ای */
    const EVENT_PERIODIC_NON_PERIODIC = 0;

    /* روزانه */
    const EVENT_PERIODIC_DAILY = 1;

    /* هفته‌ای */
    const EVENT_PERIODIC_WEEKLY = 7;

    /* دو هفته‌ای */
    const EVENT_PERIODIC_TWO_WEEKLY = 14;

    /* ماهانه */
    const EVENT_PERIODIC_MONTHLY = 30;
}
