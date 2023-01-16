<?php

namespace App\Mixins;

use Closure;
use Illuminate\Support\Str;

class StrMixin
{
    public function secureMobile(): callable
    {
        return static function ($word, $replacement = 'x') {
            $len = strlen($word);
            $prefix_number = substr($word, 0, ($len - 7));
            $secure_section = str_repeat($replacement, 6);
            $postfix_number = substr($word, -2);

            return "{$prefix_number}{$secure_section}{$postfix_number}";
        };
    }

    public function prepareShebaNo(): callable
    {
        return static function ($value) {
            if(strlen($value) <= 24)
            {
                $value = "IR{$value}";
            }
            return $value;
        };
    }

    public function randomPassword(): callable
    {
        return static function ($length = 5) {
            // $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $permitted_chars = 'abcdefgh';
            $permitted_numbers = '123456789';
            // Output: a1234
            return substr(str_shuffle($permitted_chars), 0, 1) . substr(str_shuffle($permitted_numbers), 0, $length-1);
        };
    }

    public function randomCode(): callable
    {
        return static function ($length = 6) {
            // $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $permitted_chars = '123456789ABCDEFGHKLMNPRSTUWXYZ123456789abcdefghijklmnopqrstuvwxyz';
            $char_code = substr(str_shuffle($permitted_chars), 0, $length);
            return  $char_code;
        };
    }

    public function randomActivationCode(): callable
    {
        return static function ($length = 5) {
            $min = (str_repeat('1', $length))*1;
            $max = (str_repeat('9', $length))*1;
            return random_int($min, $max);
        };
    }

    public function fetchNumbers(): callable
    {
        return static function (string $string) {
            preg_match_all('!\d+!', $string, $matches);
            return $matches[0];
        };
    }

    public function replaceSpace(): callable
    {
        return static function ($string, string $replacement = ' ') {
            return preg_replace('!\s+!', $replacement, $string);
        };
    }

    public function ltrimZero(): callable
    {
        return static function (string $string) {
            return ltrim($string, '0');
        };
    }

    public function paste(): callable
    {
        return static function (...$words) {
            return implode('', $words);
        };
    }

    public function makeLink(): callable
    {
        return static function (string $title = '', string $href = '#', string $class = '', string $target = '_self')
        {
            return "<a href='{$href}' target='{$target}' class='{$class}'>{$title}</a>";
        };
    }

    public function slugFa(): callable
    {
        return static function (string $string, string $separator = '-') {
            $flip = $separator == '-' ? '_' : '-';
            $string = preg_replace('![' . preg_quote($flip) . ']+!u', $separator, $string);
            $string = preg_replace('![^' . preg_quote($separator) . '\pL\pN\s]+!u', '', mb_strtolower($string));
            $string = preg_replace('![' . preg_quote($separator) . '\s]+!u', $separator, $string);
            return trim($string, $separator);
        };
    }

    public function numberFa(): callable
    {
        return static function ($numbers) {
            $characters = [
                '0' => '۰',
                '1' => '۱',
                '2' => '۲',
                '3' => '۳',
                '4' => '۴',
                '5' => '۵',
                '6' => '۶',
                '7' => '۷',
                '8' => '۸',
                '9' => '۹',
                0 => '۰',
                1 => '۱',
                2 => '۲',
                3 => '۳',
                4 => '۴',
                5 => '۵',
                6 => '۶',
                7 => '۷',
                8 => '۸',
                9 => '۹',
           ];

           if(is_string($numbers))
           {
               return str_replace(array_keys($characters), array_values($characters), $numbers);
           }
           else
           {
               return $numbers;
           }
        };
    }

    public function charToValidChar(): callable
    {
        return static function ($string) {
            $characters = [
            //    'ء' => '',
            //    'إ' => 'ا',
            //    'أ' => 'ا',
            //    'بِ' => 'ب',
            //    'دِ' => 'د',
            //    'ذِ' => 'ذ',
            //    'زِ' => 'ز',
            //    'سِ' => 'س',
            //    'شِ' => 'ش',
                'ك' => 'ک',
            //'ؤ' => 'و',
            //'ى' => 'ی',
                'ي' => 'ی',
            //'ئ' => 'ی',
                'ة' => 'ه',
                'ۀ' => 'ه',

                '۰' => '0',
                '۱' => '1',
                '۲' => '2',
                '۳' => '3',
                '۴' => '4',
                '۵' => '5',
                '۶' => '6',
                '۷' => '7',
                '۸' => '8',
                '۹' => '9',

                '٠' => '0',
                '١' => '1',
                '٢' => '2',
                '٣' => '3',
                '٤' => '4',
                '٥' => '5',
                '٦' => '6',
                '٧' => '7',
                '٨' => '8',
                '٩' => '9',
            ];

            if(is_string($string))
            {
                return str_replace(array_keys($characters), array_values($characters), $string);
            }
            else
            {
                return $string;
            }
        };
    }

    public function englishAlphabets(): callable
    {
        return static function () {
            return
            $alphabet = [
                'A',
                'B',
                'C',
                'D',
                'E',
                'F',
                'G',
                'H',
                'I',
                'J',
                'K',
                'L',
                'M',
                'N',
                'O',
                'P',
                'Q',
                'R',
                'S',
                'T',
                'U',
                'V',
                'W',
                'X',
                'Y',
                'Z',
            ];
        };
    }


    public function concatPrefixToMobileNo(): callable
    {
        return static function ($value)
        {
            if($value)
            {
                $prefix = '+98';
                if($value[0] == '0')
                {
                    return $prefix . substr($value,1);
                }
                elseif($value[0] != '+')
                {
                    return "{$prefix}{$value}";
                }
            }
            return $value;
        };
    }

    public function removeCountryCodeFromMobileNo(): callable
    {
        return static function ($value)
        {
            // Remove +98
            $value = (string)Str::of($value)->replace('+98', '0');

            // Add '0' to first of the mobile no
            $firstValue = Str::substr($value, 0, 1);
            if($firstValue != '0')
            {
                $value = "0{$value}";
            }

            return $value;
        };
    }
}
