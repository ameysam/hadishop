<?php

namespace App\Models;

use App\Traits\Center\CenterAccessorTrait;
use App\Traits\Center\CenterMethodTrait;
use App\Traits\Center\CenterRelationTrait;
use App\Traits\Center\CenterScopeTrait;
use App\Traits\File\FileableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    // use HasFactory;
    use
        SoftDeletes,
        FileableTrait,
        CenterRelationTrait,
        CenterAccessorTrait,
        CenterMethodTrait,
        CenterScopeTrait;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'admins_quick' => 'array',
    ];
}
