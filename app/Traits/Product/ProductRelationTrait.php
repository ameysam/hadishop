<?php

namespace App\Traits\Product;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ProductRelationTrait
{
    /**
     * @return BelongsTo
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
