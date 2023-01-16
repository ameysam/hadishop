<?php

namespace App\Services\Grid;

use App\Services\DateTime\DateTimeService;
use Exception;
use App\Services\DateTimeHelper\DateConverter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Morilog\Jalali\CalendarUtils;
use Illuminate\Support\Str;

trait Filter
{
    /**
     * Indicates the field, operator and value of requested row of search
     *
     * @var array
     */
    protected $filter;

    protected function filter(Request $request, $query)
    {
        $this->filter = json_decode($request['filterRules'], true);

        if (!$request->has('filterRules'))
        {
            return $query;
        }

        foreach ($this->filter as $i => $item)
        {
            // Try to convert the field to the date \
            try
            {
                $item['value'] = CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $item['value'] . ' 00:00:00');
                // $item['value'] = DateConverter::toGregorian($item['value'] . ' 00:00:00')->format('Y-m-d');
            }
            catch (Exception $e) {}

            switch ($item['op']) {
                case 'contains':
                    if(in_array($item['field'], ['sender', 'receiver', 'user', 'author', 'controller', 'model']))
                    {
                        $query->whereHas($item['field'], function ($q) use ($item) {
                            $q->where(function ($q) use ($item){
                                $q->where('first_name', 'LIKE', "%{$item['value']}%")
                                    ->orWhere('last_name', 'LIKE', "%{$item['value']}%");
                            });
                        });
                    }
                    elseif(in_array($item['field'], ['birth_country', 'location_country', 'service']))
                    {
                        $query->whereHas(Str::camel($item['field']), function ($q) use ($item) {
                            $q->where('name', 'LIKE', "%{$item['value']}%");
                        });
                    }
                    elseif(in_array($item['field'], ['province', 'city']))
                    {
                        $query->whereHas(Str::camel($item['field']), function ($q) use ($item) {
                            $q->where('title', 'LIKE', "%{$item['value']}%");
                        });
                    }
                    else
                    {
                        $names = explode('_', $item['field']);
                        if(in_array($names[0], ['user']))
                        {
                            $module_name = $names[0];
                            unset($names[0]);
                            $field_name = implode('_', $names);

                            $query->whereHas($module_name, function ($q) use ($item, $field_name ) {
                                $q->where($field_name , 'LIKE', "%{$item['value']}%");
                            });
                        }
                        else if(in_array($names[0], ['roles', 'users']))
                        {
                            $module_name = $names[0];
                            unset($names[0]);
                            $field_name = implode('_', $names);

                            $query->where("{$module_name}.{$field_name}", 'LIKE', "%{$item['value']}%");
                        }
                        else
                        {
                            $query->where($item['field'], 'LIKE', "%{$item['value']}%");
                        }
                    }
                    break;
                case 'equal_date':
                    $query->where($item['field'], 'LIKE', "%{$item['value']}%");
                    break;
                case 'equal':
                    $names = explode('_', $item['field']);
                    if(count($names) > 1)
                    {
                        $module_name = $names[0];
                        if($module_name == 'groups')
                        {
                            unset($names[0]);
                            $field_name = implode('_', $names);
                            $query->whereHas($module_name, function ($q) use ($item, $field_name) {
                                $q->where("$field_name", $item['value']);
                            });
                        }
                        elseif($module_name == 'role')
                        {
                            unset($names[0]);
                            $field_name = implode('_', $names);
                            $query->whereHas('roles', function ($q) use ($item, $field_name) {
                                $q->where($field_name, $item['value']);
                            });
                        }
                        else
                        {
                            $query->where($item['field'], $item['value']);
                        }
                    }
                    else
                    {
                        $query->where($item['field'], $item['value']);
                    }
                    break;
                case 'notequal':
                    $query->where($item['field'], '<>', $item['value']);
                    break;
                case 'less_date':
                    $query->where($item['field'], '<', $item['value'] . ' 00:00:00');
                    break;
                case 'lessorequal':
                    $query->where($item['field'], '<=', $item['value']);
                    break;
                case 'greater_date':
                    $query->where($item['field'], '>', $item['value'] . ' 23:59:59');
                    break;
                case 'greaterorequal':
                    $query->where($item['field'], '>=', $item['value']);
                    break;
                case 'where_has':
                    $query->whereHas($item['field'], function ($q) use ($item) {
                        $q->where('id', $item['value']);
                    });
                    break;
                case 'status':
                    if ($item['value'] === 'active') {
                        $query->whereNull('deleted_at');
                    } else {
                        $query->whereNotNull('deleted_at');
                    }
                    break;
                case 'inactive_status':
                    if ($item['value'] === 'active') {
                        $query->whereNull('inactive_at');
                    } else {
                        $query->whereNotNull('inactive_at');
                    }
                    break;
            }
        }

        return $query;
    }
}
