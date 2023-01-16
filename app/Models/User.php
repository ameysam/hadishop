<?php

namespace App\Models;

use App\Traits\User\UserAccessorTrait;
use App\Traits\User\UserMethodTrait;
use App\Traits\User\UserMutatorTrait;
use App\Traits\User\UserRelationTrait;
use App\Traits\User\UserScopeTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory,
        Notifiable,
        HasRoles,
        SoftDeletes,
        UserMutatorTrait,
        UserRelationTrait,
        UserMethodTrait,
        UserScopeTrait,
        UserAccessorTrait
        ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mobile_no',
        'first_name',
        'last_name',
        'id_no',
        'image',
        'gender',
        'birthdate',
        'email',
        'password',
        'province_id',
        'city_id',
        'activation_type',
        'activation_status',
        'activation_token',
        'center_creator_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'full_name',
    ];


    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
