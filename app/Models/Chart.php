<?php

namespace App\Models;

class Chart extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Chart::class, 'parent_id', 'id');
    }

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id', 'id');
    }

    public function child()
    {
        return $this->hasMany(Chart::class, 'parent_id');
    }


    public function children()
    {
        return $this->child()
            ->with('children');
    }
}
