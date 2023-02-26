<?php

namespace App\Models;

use App\Traits\File\FileableTrait;
use App\Traits\Product\ProductAccessorTrait;
use App\Traits\Product\ProductMethodTrait;
use App\Traits\Product\ProductRelationTrait;
use App\Traits\Product\ProductScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,
        SoftDeletes,
        FileableTrait,
        ProductScopeTrait,
        ProductMethodTrait,
        ProductRelationTrait,
        ProductAccessorTrait
        ;


    protected $searchable = [
        'name',
        'description',
    ];
}
