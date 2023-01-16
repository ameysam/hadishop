<?php

namespace App\Models;

class ModelHasRoles extends Model
{
    protected $table = 'model_has_roles';


    public function role()
    {
        return $this->belongsTo(CustomRole::class, 'role_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'model_id', 'id');
    }
}
