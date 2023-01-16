<?php

namespace App\Mixins;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ArrMixin
{
    public function toObject(): callable
    {
        return static function (array $array, string $className) {
            return unserialize(sprintf(
                'O:%d:"%s"%s',
                strlen($className),
                $className,
                strstr(serialize($array), ':')
            ));
        };
    }

    public function toJson(): callable
    {
        return static function (array $data) {
            $item_array[] = [
                'text' => __('custom.all_items'),
                'value' => '',
            ];

            if(Arr::isAssoc($data))
            {
                foreach ($data as $key => $value)
                {
                    $item_array[] = [
                        'text' => $value,
                        'value' => $key,
                    ];
                }
            }
            else
            {
                foreach ($data as $value)
                {
                    $item_array[] = [
                        'text' => $value,
                        'value' => $value,
                    ];
                }
            }
            return json_encode($item_array);
        };
    }

    public function getDayMinutesAsHourFormat(): callable
    {
        return static function (int $quarter_count = 96, $format = 'timespan') {
            $times = [];

            $i = 1;
            if($format != 'timespan')
            {
                $i = 0;
                $quarter_count--;
            }

            for($i; $i <= $quarter_count; $i++)
            {
                $minute = $i*15;

                $key = "دقیقه";
                if($i <= 3)
                {
                    if($minute < 10)
                    {
                        $minute = "0{$minute}";
                    }
                    $value = "00:" . ($minute);
                }
                else
                {
                    $key = "ساعت";
                    $temp = $minute / 60;
                    $value = floor($temp);
                    if($value < 10)
                    {
                        $value = "0{$value}";
                    }
                    $temp = $minute % 60;
                    if($temp < 10)
                    {
                        $temp .= '0';
                    }
                    $value .= ':' . $temp;
                }

                $times[$minute] = [
                    'format' => $key,
                    'value' => ($value),
                ];
            }

            return $times;
        };
    }
    
    public function getDailyHours(): callable
    {
        return static function () {
            $houres = [];
            foreach (range(0, 23) as $number) {
                if($number < 10)
                {
                    $number = "0{$number}";
                }
                $houres[] = "{$number}";
            }
            return $houres;
        };
    }
    
    public function getDailyMinutes(): callable
    {
        return static function () {
            $minutes = [];
            foreach (range(0, 45, 15) as $number) {
                if($number < 10)
                {
                    $number = "0{$number}";
                }
                $minutes[] = "{$number}";
            }
            return $minutes;
        };
    }


}
