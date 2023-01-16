<?php

namespace App\Traits\MessageUser;

use App\Constants\Types\MessageUser\MessageUserStatusType;

/**
 * Trait MessageUserMethodTrait
 */
trait MessageUserScopeTrait
{
    public function scopeWhereSeen($query)
    {
        return $query->where('status', MessageUserStatusType::MESSAGE_USER_STATUS_SEEN);
    }

    public function scopeWhereUnseen($query)
    {
        return $query->where('status', MessageUserStatusType::MESSAGE_USER_STATUS_UNSEEN);
    }

    
    public function scopeWhereUser($query, array $users_ids)
    {
        return $query->whereIn('user_id', $users_ids);
    }
}
