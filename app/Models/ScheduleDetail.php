<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleDetail extends Model
{
    use SoftDeletes;

    protected $table = 'schedule_details';
}
