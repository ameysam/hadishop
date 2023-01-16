<?php

namespace App\Models;

use App\Traits\File\FileableTrait;
use App\Traits\Message\MessageAccessorTrait;
use App\Traits\Message\MessageMethodTrait;
use App\Traits\Message\MessageRelationTrait;
use App\Traits\Message\MessageScopeTrait;

class Message extends Model
{
    use
        FileableTrait,
        MessageRelationTrait,
        MessageScopeTrait,
        MessageAccessorTrait,
        MessageMethodTrait
        ;
}
