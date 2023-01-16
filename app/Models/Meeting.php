<?php

namespace App\Models;

use App\Traits\Comment\CommentableTrait;
use App\Traits\Meeting\MeetingAccessorTrait;
use App\Traits\Meeting\MeetingMethodTrait;
use App\Traits\Meeting\MeetingRelationTrait;
use App\Traits\Meeting\MeetingScopeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use SoftDeletes,
        MeetingScopeTrait,
        MeetingRelationTrait,
        MeetingAccessorTrait,
        MeetingMethodTrait,
        CommentableTrait
        ;
}
