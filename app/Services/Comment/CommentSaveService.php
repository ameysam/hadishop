<?php

namespace App\Services\Comment;

use App\Models\Center;
use App\Models\Comment;
use App\Models\Model;
use App\Models\User;

class CommentSaveService
{
    private $user;

    private $center;

    private $model;

    private $content;

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function setCenter(Center $center = null)
    {
        $this->center = $center;
        return $this;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    public function setContnet(string $content = '')
    {
        $this->content = $content;
        return $this;
    }


    public function save()
    {
        $comment = Comment::create([
            'user_id' => $this->user->id,
            'center_id' => $this->center->id ?? null,
            'commentable_id' => $this->model->id,
            'commentable_type' => $this->model->getClass(),
            'content' => $this->content,
        ]);

        return $comment;
    }
}
