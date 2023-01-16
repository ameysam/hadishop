<?php

namespace App\Traits\Message;

use App\Constants\Types\Message\MessageType;
use App\Constants\Types\MessageUser\MessageUserStatusType;

/**
 * Trait MessageMethodTrait
 * @package App\Traits\Message
 */
trait MessageScopeTrait
{
    public function scopeWhereSystemic($query)
    {
        return $query->where('status', MessageType::MESSAGE_SYSTEMIC);
    }

    public function scopeWhereNonSystemic($query)
    {
        return $query->where('status', MessageType::MESSAGE_NON_SYSTEMIC);
    }
    
    public function scopeWhereUser($query, array $users_ids)
    {
        return $query->whereHas('users', function($query) use ($users_ids){
            $query->whereIn('user_id', $users_ids);
        });
    }

    public function scopeWhereUserUnseen($query, array $users_ids)
    {
        return $query->whereHas('users', function($query) use ($users_ids){
            $query
                ->whereIn('user_id', $users_ids)
                ->where('status', MessageUserStatusType::MESSAGE_USER_STATUS_UNSEEN);
        });
    }
}
