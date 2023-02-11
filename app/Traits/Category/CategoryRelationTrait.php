<?php

namespace App\Traits\Category;

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait CategoryRelationTrait
{
    /**
     * @return HasMany
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
