<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NationalNo implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return true;
        // if(in_dev())
        // {
        //     return true;
        // }

        if( preg_match('/^\d{10}$/', $value))
        {
            if (in_array($value, ['1111111111', '2222222222', '3333333333', '4444444444', '5555555555', '6666666666', '7777777777', '8888888888', '9999999999', '0000000000']))
            {
                return false;
            }

            // if (strpos($value.'', '99999') !== false)
            // {
            //     return true;
            // }

            $list_code = str_split($value);
            $last = (int)$list_code[9];
            unset($list_code[9]);
            $i = 10;
            $sum = 0;
            foreach ($list_code as $key => $_)
            {
                $sum += intval($_) * $i;
                $i--;
            }

            $mod = (int)$sum % 11;

            if ($mod >= 2)
                $mod = 11 - $mod;

            return $mod == $last;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'فیلد «:attribute» معتبر نیست.';
    }
}
