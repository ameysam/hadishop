<?php

namespace App\Models;

use App\Traits\Schedule\ScheduleAccessorTrait;
use App\Traits\Schedule\ScheduleMethodTrait;
use App\Traits\Schedule\ScheduleRelationTrait;
use App\Traits\Schedule\ScheduleScopeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes,
        ScheduleScopeTrait,
        ScheduleRelationTrait,
        ScheduleAccessorTrait,
        ScheduleMethodTrait
        ;
}
