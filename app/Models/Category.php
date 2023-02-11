<?php

namespace App\Models;

use App\Traits\Category\CategoryAccessorTrait;
use App\Traits\Category\CategoryMethodTrait;
use App\Traits\Category\CategoryRelationTrait;
use App\Traits\Category\CategoryScopeTrait;
use App\Traits\File\FileableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use
        HasFactory,
        FileableTrait,
        SoftDeletes,
        CategoryScopeTrait,
        CategoryMethodTrait,
        CategoryAccessorTrait,
        CategoryRelationTrait
        ;
}
