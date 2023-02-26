<?php

namespace App\Traits\Product;

/**
 * Trait ProductMethodTrait
 * @package App\Traits\Product
 */
trait ProductScopeTrait
{
    public function scopeWhereCategory($query, $category)
    {
        return $query->where('category_id', $category->id);
    }

    public function scopeWhereSuggest($query)
    {
        return $query->where('suggest', 1);
    }

    public function scopeWhereAvailable($query)
    {
        return $query->where('available', 1);
    }

    public function scopeOrderAvailable($query)
    {
        return $query->orderBy('available', 'DESC');
    }
}
