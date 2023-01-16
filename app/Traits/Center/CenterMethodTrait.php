<?php

namespace App\Traits\Center;

use App\Constants\Types\Center\CenterStatusType;
use App\Constants\Types\Center\CenterType;
use App\Models\CenterSection;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

/**
 * Trait CenterMethodTrait
 * @package App\Traits\Center
 */
trait CenterMethodTrait
{
    public function adminRoleName()
    {
        return "{$this->id}-admin-center";
    }


    public function getAdmins(array $fields = ['*'])
    {
        return User::findMany($this->admins_quick, $fields);
    }


    public function isActive()
    {
        return $this->status == CenterStatusType::CENTER_STATUS_ACTIVE;
    }

    public function isInactive()
    {
        return $this->status == CenterStatusType::CENTER_STATUS_INACTIVE;
    }


    public function getLogoDisplayPath()
    {
        if(!$this->files->isEmpty())
        {
            return config('filesystems.files_link') . "/{$this->files[0]->uploaded_name}";
        }
        return 'no-image.png';
    }
}
