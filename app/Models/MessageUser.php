<?php

namespace App\Models;

use App\Traits\MessageUser\MessageUserAccessorTrait;
use App\Traits\MessageUser\MessageUserMethodTrait;
use App\Traits\MessageUser\MessageUserRelationTrait;
use App\Traits\MessageUser\MessageUserScopeTrait;

class MessageUser extends Model
{
    use MessageUserRelationTrait,
        MessageUserScopeTrait,
        MessageUserAccessorTrait,
        MessageUserMethodTrait
        ;

    public $timestamps = false;

    protected $table = 'message_user';
}
