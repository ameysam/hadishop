<?php


namespace App\Traits\Center;

use App\Constants\Types\Center\CenterStatusType;

/**
 * Trait CenterAccessorTrait
 */
trait CenterAccessorTrait
{
    public function getStatusFaAttribute()
    {
        $result = null;
        if($this->status)
        {
            $result = CenterStatusType::getValue($this->status);
        }

        return $result;
    }
}
