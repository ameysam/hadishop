<?php

namespace App\Models;

use App\Traits\File\FileableTrait;
use App\Traits\Slider\SliderAccessorTrait;
use App\Traits\Slider\SliderMethodTrait;
use App\Traits\Slider\SliderRelationTrait;
use App\Traits\Slider\SliderScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory,
        FileableTrait,
        SliderScopeTrait,
        SliderMethodTrait,
        SliderRelationTrait,
        SliderAccessorTrait
        ;
}
