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

class MessageSendService
{
    private $sender;

    private $type;

    private $receivers;

    private $title;

    private $content;

    private $sender_name;

    private $model;

    public function setSender(User $user)
    {
        $this->sender = $user;
        $this->sender_name = $user->full_name;
        return $this;
    }

    public function setType(?int $value)
    {
        $this->type = $value;
        return $this;
    }

    public function setSenderName(?string $value)
    {
        $this->sender_name = $value;
        return $this;
    }

    public function setTitle(string $value = '')
    {
        $this->title = $value;
        return $this;
    }

    public function setContent(string $content = '')
    {
        $this->content = $content;
        return $this;
    }

    public function setReceivers(array $receivers = [])
    {
        $this->receivers = $receivers;
        return $this;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    public function send()
    {
        $message = Message::create([
            'sender_id' => $this->sender->id ?? null,
            'sender_name' => $this->sender_name ?? null,
            'type' => $this->type ?? MessageType::MESSAGE_SYSTEMIC,
            'title' => $this->title,
            'content' => $this->content,
            'messageable_id' => isset($this->model) ? $this->model->id : null,
            'messageable_type' => isset($this->model) ? $this->model->getClass() : null,
        ]);

        $message->users()->sync($this->receivers);

        return $message;
    }
}
