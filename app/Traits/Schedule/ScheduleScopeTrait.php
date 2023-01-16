<?php

namespace App\Traits\Schedule;

use App\Models\Center;

trait ScheduleScopeTrait
{
    public function scopeWhereCenter($query, $center)
    {
        $center_id = $center;
        if($center instanceof Center)
        {
            $center_id = $center->id;
        }

        return $query->where('center_id', $center_id);
    }

    public function scopeOrderByName($query, $type = 'ASC')
    {
        return $query->orderBy('name', $type);
    }
}
