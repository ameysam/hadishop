<?php

namespace App\Traits\Comment;

trait CommentRelationTrait
{
    public function commentable()
    {
        return $this->morphTo();
    }
}
