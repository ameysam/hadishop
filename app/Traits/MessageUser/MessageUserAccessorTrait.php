<?php


namespace App\Traits\MessageUser;

use App\Constants\Types\MessageUser\MessageUserStatusType;

/**
 * Trait MessageAccessorTrait
 */
trait MessageUserAccessorTrait
{
    public function getStatusFaAttribute()
    {
        $result = null;
        if($this->status)
        {
            $result = MessageUserStatusType::getValue($this->status);
        }

        return $result;
    }
}
