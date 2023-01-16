<?php

namespace App\Models;

use App\Traits\Comment\CommentRelationTrait;
use App\Traits\File\FileableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes,
        CommentRelationTrait,
        FileableTrait
    ;
}
