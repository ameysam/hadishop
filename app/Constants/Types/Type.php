<?php

namespace App\Constants\Types;


use ReflectionClass;

/**
 * Class Type
 * @author M.Alipuor <meysam.alipuor@gmail.com>
 */
class Type
{

    /**
     * @var bool
     */
    private static $with_filtering_dont_selectables = false;


    /**
     * @throws \ReflectionException
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public static function getConstants()
    {
        $child_class = get_called_class();

        if(self::$with_filtering_dont_selectables == true && method_exists($child_class, "selectable"))
        {
            $constants = $child_class::selectable();
        }
        else
        {
            $reflect = new ReflectionClass($child_class);
            $constants = $reflect->getConstants();
        }

        return $constants;
    }

    /**
     * Make an array of caller class constants ($key is constant value and $value is constant synonym).
     *
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    private static function values()
    {
        $values = [];

        $constants = self::getConstants();

        foreach ($constants as $k => $v)
        {
            $values[$v] = __("custom.constants.{$k}");
        }

        return $values;
    }


    /**
     * Filter and return all of caller class constants.
     *
     * @param string $section
     * @param bool $with_filtering_dont_selectables
     * @return array
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public static function getValues($section = 'both', $with_filtering_dont_selectables = false)
    {
        self::$with_filtering_dont_selectables = $with_filtering_dont_selectables;

        $values = self::values();

        if(in_array($section, ['key', 'keys']))
        {
            return array_keys($values);
        }
        elseif(in_array($section, ['value', 'values']))
        {
            return array_values($values);
        }
        else
        {
            return $values;
        }
    }

    /**
     * Return a caller class constant filter by constant value.
     *
     * @param $const_value
     * @param bool $with_filtering_dont_selectables
     * @return mixed|null
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public static function getValue($const_value, $with_filtering_dont_selectables = false)
    {
        self::$with_filtering_dont_selectables = $with_filtering_dont_selectables;

        $values = self::values();
        if(empty($values[$const_value]))
        {
            return null;
        }

        return $values[$const_value];
    }


    /**
     * Return all of caller class constants as a json for represent in easyui grid.
     *
     * @param bool $with_filtering_dont_selectables
     * @return false|string
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public static function toJson($with_filtering_dont_selectables = false)
    {
        $items = self::getValues('both', $with_filtering_dont_selectables);

        $item_array[] = [
            'text' => __('custom.all_items'),
            'value' => '',
        ];

        foreach ($items as $key => $value) {
            $item_array[] = [
                'text' => $value,
                'value' => $key,
            ];
        }

        return json_encode($item_array);
    }
}
