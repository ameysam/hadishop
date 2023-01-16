<?php

namespace App\Traits\MessageUser;

use App\Constants\Types\MessageUser\MessageUserStatusType;

/**
 * Trait MessageUserMethodTrait
 */
trait MessageUserMethodTrait
{
    public function isSeen()
    {
        return $this->status == MessageUserStatusType::MESSAGE_USER_STATUS_SEEN;
    }

    public function isUnseen()
    {
        return $this->status == MessageUserStatusType::MESSAGE_USER_STATUS_UNSEEN;
    }
}
