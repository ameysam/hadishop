<?php

namespace App\Traits\Meeting;

use App\Constants\Types\Meeting\MeetingHoldingStatusType;
use App\Constants\Types\Meeting\MeetingStatusType;
use App\Models\Center;
use App\Models\Room;

trait MeetingScopeTrait
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

    public function scopeWhereActive($query)
    {
        return $query->where('status', MeetingStatusType::MEETING_STATUS_ACTIVE);
    }

    public function scopeWhereCanceled($query)
    {
        return $query->where('status', MeetingStatusType::MEETING_STATUS_CANCELED);
    }

    public function scopeWhereActiveOrCanceled($query)
    {
        return $query->whereIn('status', [MeetingStatusType::MEETING_STATUS_ACTIVE, MeetingStatusType::MEETING_STATUS_CANCELED]);
    }

    public function scopeWhereWillBeExpired($query)
    {
        return
            $query->where('holding_status', '<=', MeetingHoldingStatusType::MEETING_HOLDING_STATUS_ON_PERFORMING)
                    ->where('finished_at', '<=', now());
    }

    public function scopeWhereNotExpired($query)
    {
        return
            $query->where('holding_status', '<=', MeetingHoldingStatusType::MEETING_HOLDING_STATUS_ON_PERFORMING)
                    ->where('finished_at', '>', now());
    }

    public function scopeOrderByName($query, $type = 'ASC')
    {
        return $query->orderBy('name', $type);
    }

    public function scopeNotStartedYet($query)
    {
        return $query->where('started_at', '<', now());
    }

    public function scopeWhereDay($query, $day)
    {
        return $query->where('day', $day);
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
                        ->orWhereHas('roles.users', function($query) use ($users_ids){
                            $query->whereIn('users.id', $users_ids);
                        });
                });
    }


    public function scopeWhereAdminOrSecretary($query, $user_id)
    {
        return
            $query
                ->where(function($query) use ($user_id){
                    $query
                        ->whereHas('center', function($query) use ($user_id){
                            $query->where('admins_quick', 'like', '%"' . $user_id . '"%');
                        })
                        ->orWhere('secretary_id', $user_id);
                })
                ->whereHas('center', function($query) use ($user_id){
                    $query->whereActive();
                });
    }
}
