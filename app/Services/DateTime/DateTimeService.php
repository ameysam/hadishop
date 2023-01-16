<?php

namespace App\Services\DateTime;

use App\Models\Month;
use Carbon\Carbon;
use Exception;
use Morilog\Jalali\CalendarUtils;

class DateTimeService
{
    /**
     * toGregorian
     * Convert selected Jalali date to Gregorian date string or Carbon.
     * If the $to_carbon field is true, the method cast generated date to Carbon type.
     *
     * @param string $year
     * @param string $month
     * @param string $day
     * @param bool $to_carbon
     * @return mixed
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public static function toGregorian($year, $month, $day, $to_carbon = false)
    {
        $date = CalendarUtils::toGregorian($year, $month, $day);

        if($to_carbon)
        {
            return self::toCarbon($date[0], $date[1], $date[2]);
        }

        return implode('-', $date);
    }


    /**
     * toCarbon
     *
     * @param string $year
     * @param string $month
     * @param string $day
     * @param string $format
     * @return Carbon
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public static function toCarbon($year, $month = null, $day = null, $format = 'Y-m-d')
    {
        if($month && $day)
        {
            return Carbon::parse("{$year}-{$month}-{$day}")->format($format);
        }

        $elements = explode('-', $year);
        if(count($elements) == 3)
        {
            return Carbon::parse("{$elements[0]}-{$elements[1]}-{$elements[2]}")->format($format);
        }
        else
        {
            throw new Exception("Invalid date format.");
        }
    }


    public static function mergeSeparateDate($year, $month, $day, $is_grigorian = false)
    {
        if($is_grigorian)
        {
            # Cast selected Gregorian date to Carbon format.
            $birthday = DateTimeService::toCarbon($year, $month, $day);
        }
        else
        {
            /*
            * Convert Jalali selected date to Gregorian date
            * After convert to Gregorian, cast the date to Carbon format.
            */
            $birthday = DateTimeService::toGregorian($year, $month, $day, true);
        }

        return $birthday;
    }
}
