<?php

namespace App\Models;

use App\Traits\Comment\CommentableTrait;
use App\Traits\Event\EventAccessorTrait;
use App\Traits\Event\EventMethodTrait;
use App\Traits\Event\EventRelationTrait;
use App\Traits\Event\EventScopeTrait;
use App\Traits\Guest\GuestableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes,
        EventScopeTrait,
        EventRelationTrait,
        EventAccessorTrait,
        EventMethodTrait,
        CommentableTrait,
        GuestableTrait
        ;
}
