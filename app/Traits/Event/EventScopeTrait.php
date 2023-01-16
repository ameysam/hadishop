<?php

namespace App\Traits\Event;

use App\Constants\Types\Event\EventPeriodicType;
use App\Constants\Types\Event\EventStatusType;
use App\Models\Center;
use App\Models\Room;

trait EventScopeTrait
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

    public function scopeWhereRoom($query, $room)
    {
        $room_id = $room;
        if($room instanceof Room)
        {
            $room_id = $room->id;
        }

        return $query->where('room_id', $room_id);
    }

    public function scopeWhereNotExpired($query)
    {
        $now = now();

        return $query->where(function($query) use ($now){
            $query
                ->where(function($query) use ($now){
                    $query
                        ->where('finished_at', '>', $now);
                })
                ->orWhere(function($query) use ($now){
                    $query
                        ->whereNull('finished_at')
                        ->where('started_at', '>', $now);
                });
        });
    }

    public function scopeWhereDay($query, $day)
    {
        return $query->where('day', $day);
    }

    public function scopeWhereActive($query)
    {
        return $query->where('status', EventStatusType::EVENT_STATUS_ACTIVE);
    }

    public function scopeWherePeriodic($query)
    {
        return $query->where('periodic_type', '!=', EventPeriodicType::EVENT_PERIODIC_NON_PERIODIC);
    }

    public function scopeOrderByName($query, $type = 'ASC')
    {
        return $query->orderBy('name', $type);
    }

    public function scopeWhereUsersContains($query, $users_ids)
    {
        if(!is_array($users_ids))
        {
            $users_ids = [$users_ids];
        }

        return
            $query
                ->where(function($query) use ($users_ids){
                    $query
                        ->whereHas('users', function($query) use ($users_ids){
                            $query->whereIn('users.id', $users_ids);
                        })
                        ->orWhereIn('user_id', $users_ids);
                });
    }
}
