<?php

namespace App\Traits\Center;

use App\Constants\Types\Center\CenterStatusType;
use App\Models\User;

/**
 * Trait CenterMethodTrait
 * @package App\Traits\Center
 */
trait CenterScopeTrait
{
    public function scopeOrderByName($query, $type = 'ASC')
    {
        return $query->orderBy('name', $type);
    }

    public function scopeWhereActive($query)
    {
        return $query->where('status', CenterStatusType::CENTER_STATUS_ACTIVE);
    }
}
