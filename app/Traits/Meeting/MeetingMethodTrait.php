<?php

namespace App\Traits\Meeting;

use App\Constants\Types\Meeting\MeetingHoldingStatusType;
use App\Constants\Types\Meeting\MeetingPeriodicType;
use App\Constants\Types\Meeting\MeetingStatusType;
use Illuminate\Support\Facades\Auth;

trait MeetingMethodTrait
{
    public static function getRecord($id)
    {
        $currentUser = Auth::user();
        $record = self::query();

        if(! $currentUser->isSuperAdmin())
        {
            $record
                ->where(function($query) use ($currentUser){
                    $query
                        ->whereHas('users', function($query) use ($currentUser){
                            $query->where('users.id', $currentUser->id);
                        })
                        ->orWhereHas('roles.users', function($query) use ($currentUser){
                            $query->where('users.id', $currentUser->id);
                        });
                })
                ->whereHas('center', function($query){
                    $query->whereActive();
                });
        }

        return $record
            // ->whereActive()
            ->whereNotExpired()
            ->find($id)
            ;
    }

    public function getSectionName()
    {
        return 'جلسه';
    }

    public function getRoute()
    {
        return route('admin.meeting.view', $this->id);
    }

    public function getAllUsersIDs()
    {
        $users = $this->users()->pluck('users.id');

        $userRoles = $this->roles()->with('users')->get();

        if($userRoles->count())
        {
            $userRoles->map(function($record) use (&$users){
                if(count($record->users))
                {
                    foreach($record->users as $user)
                    {
                        if(! $users->contains($user->id))
                        {
                            $users->push($user->id);
                        }
                    }
                }
            });
        }

        return $users->toArray();
    }

    public function isActive()
    {
        return $this->status == MeetingStatusType::MEETING_STATUS_ACTIVE;
    }
    public function isCanceled()
    {
        return $this->status == MeetingStatusType::MEETING_STATUS_CANCELED;
    }

    public function isWaitingForStart()
    {
        return $this->holding_status == MeetingHoldingStatusType::MEETING_HOLDING_STATUS_WAITING_FOR_START;
    }

    public function isOnPerforming()
    {
        return $this->holding_status == MeetingHoldingStatusType::MEETING_HOLDING_STATUS_ON_PERFORMING;
    }

    public function isTerminated()
    {
        return $this->holding_status == MeetingHoldingStatusType::MEETING_HOLDING_STATUS_TERMINATED;
    }

    public function isNotHeld()
    {
        return $this->holding_status == MeetingHoldingStatusType::MEETING_HOLDING_STATUS_NOT_HELD;
    }


    public function isExpired()
    {
        return ($this->holding_status > MeetingHoldingStatusType::MEETING_HOLDING_STATUS_ON_PERFORMING);
    }

    public function isPeriodic()
    {
        return $this->periodic_type > MeetingPeriodicType::MEETING_PERIODIC_NON_PERIODIC;
    }

    public function isNotStartedYet()
    {
        return $this->started_at > now();
    }


    public function getCurrentUserPivotRecord($user)
    {
        $result = null;
        if($this->users->count())
        {
            $result =
                $this->users->filter(function ($user_record) use ($user) {
                    return $user_record->id == $user->id;
                });

            return $result->first();
        }

        return $result;
    }


    public function getAllUsers()
    {
        $users = $this->users()->get();

        $userRoles = $this->roles()->with('users')->get();

        if($userRoles->count())
        {
            $userRoles->map(function($record) use (&$users){
                if(count($record->users))
                {
                    foreach($record->users as $user)
                    {
                        if(! $users->contains('id', $user->id))
                        {
                            $users->push($user);
                        }
                    }
                }
            });
        }

        return $users;
    }


    public function holdingStatusColor()
    {
        if($this->isWaitingForStart())
        {
            return 'primary';
        }
        else if($this->isOnPerforming())
        {
            return 'success';
        }
        else if($this->isTerminated())
        {
            return 'dark';
        }
        else
        {
            return 'danger';
        }
    }
}
