<?php

namespace App\Traits\Event;

use App\Constants\Types\Event\EventPeriodicType;
use App\Constants\Types\Event\EventStatusType;
use Illuminate\Support\Facades\Auth;

trait EventMethodTrait
{
    public static function getRecord($id)
    {
        $currentUser = Auth::user();

        $record = self::query();

        return $record->find($id);
    }

    public function getSectionName()
    {
        return 'رویداد';
    }

    public function getRoute()
    {
        return route('admin.event.view', $this->id);
    }

    public function getAllUsersIDs()
    {
        $users_ids = $this->users()->pluck('users.id');
        return $users_ids->toArray();
    }

    public function isActive()
    {
        return $this->status == EventStatusType::EVENT_STATUS_ACTIVE;
    }

    public function isExpired()
    {
        return false;
    }

    public function isPeriodic()
    {
        return $this->periodic_type > EventPeriodicType::EVENT_PERIODIC_NON_PERIODIC;
    }
}
