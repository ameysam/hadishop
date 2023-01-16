<?php

namespace App\Services\DateTime;

use App\Constants\Days;
use Illuminate\Support\Traits\Macroable;

class DateTimeComponentsConvertService
{
    public static function minToSecond(int $minutes): int
    {
        return (60 * $minutes);
    }

    public static function dayToSecond(int $days): int
    {
        return (86400 * $days);
    }

    public static function daysRange($max = 31)
    {
        return range(1, $max);
    }

    public static function yearsRange($type = 1, $difference = 120)
    {
        if($type == 1)
        {
            return range(Days::J_Y, Days::J_Y - $difference);
        }
        else
        {
            return range(Days::G_Y, Days::G_Y - $difference);
        }
    }
}
