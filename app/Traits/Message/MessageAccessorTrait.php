<?php


namespace App\Traits\Message;

use App\Constants\Types\Message\MessageType;

/**
 * Trait MessageAccessorTrait
 */
trait MessageAccessorTrait
{
    public function getTypeFaAttribute()
    {
        $result = null;
        if($this->type)
        {
            $result = MessageType::getValue($this->type);
        }

        return $result;
    }

    public function getCreatedAtFaAttribute()
    {
        $result = null;
        if($this->created_at)
        {
            $result = jdate($this->created_at)->format('H:i - Y/m/d');
        }

        return $result;
    }
}
