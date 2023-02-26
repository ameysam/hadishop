<?php

namespace App\Traits\Product;

use App\Services\Search\FullTextSearchService;
use Illuminate\Support\Str;
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

    public function scopeSearch($query, $term)
    {
        $term = Str::replaceSpace($term);

        $columns = implode(',', $this->searchable);

        $full_text_will_cards = new FullTextSearchService($term);

        $query->whereRaw("MATCH ({$columns}) AGAINST (? IN NATURAL LANGUAGE MODE)", $full_text_will_cards->prepareText('or'));

        return $query;
    }
}
