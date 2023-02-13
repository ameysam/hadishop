<?php

namespace App\Traits\Product;

/**
 * Trait ProductMethodTrait
 * @package App\Traits\Product
 */
trait ProductScopeTrait
{

    public function scopeWhereSuggest($query)
    {
        return $query->where('suggest', 1);
    }
}
