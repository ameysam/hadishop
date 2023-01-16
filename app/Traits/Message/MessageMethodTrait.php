<?php

namespace App\Traits\Message;

use App\Constants\Types\Message\MessageType;

/**
 * Trait MessageMethodTrait
 * @package App\Traits\Message
 */
trait MessageMethodTrait
{
    public function isSystemic()
    {
        return $this->status == MessageType::MESSAGE_SYSTEMIC;
    }

    public function isNonSystemic()
    {
        return $this->status == MessageType::MESSAGE_NON_SYSTEMIC;
    }
}
