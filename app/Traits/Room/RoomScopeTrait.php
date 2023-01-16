<?php

namespace App\Traits\Room;

use App\Models\Center;

/**
 * Trait RoomScopeTrait
 * @package App\Traits\Room
 */
trait RoomScopeTrait
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
