<?php

namespace App\Traits\Category;

use Illuminate\Support\Str;

trait CategoryMethodTrait
{
    public function urlShow()
    {
        return route('front.category.show', [$this->id, Str::replaceSpace($this->name, '-')]);
    }
}
