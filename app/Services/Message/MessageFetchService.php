<?php

namespace App\Services\Message;

use App\Constants\Types\Message\MessageType;
use App\Constants\Types\MessageUser\MessageUserStatusType;
use App\Models\Center;
use App\Models\Comment;
use App\Models\Message;
use App\Models\MessageUser;
use App\Models\Model;
use App\Models\User;

class MessageFetchService
{
    private $sender;

    private $type;

    private $status;

    private $receivers;

    private $title;

    private $content;

    private $sender_name;

    private $model;

    public function setSender(User $user)
    {
        $this->sender = $user;
        return $this;
    }

    public function setType(?int $value)
    {
        $this->type = $value;
        return $this;
    }

    public function whereUnseen()
    {
        $this->status = MessageUserStatusType::MESSAGE_USER_STATUS_UNSEEN;
        return $this;
    }

    public function whereReceivers(?array $receivers)
    {
        $this->receivers = $receivers;
        return $this;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    public function prepareQuery()
    {
        $query = Message::query();

        if($this->receivers && $this->status == null)
        {
            $query->whereUser($this->receivers);
        }
        if($this->receivers && $this->status)
        {
            $query->whereUserUnseen($this->receivers);
        }

        return $query;
    }
}
