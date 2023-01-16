<?php


namespace App\Traits\User;

use App\Constants\Types\User\UserActivationType;
use App\Models\Center;
use Spatie\Permission\Models\Permission;

trait UserMethodTrait
{
    /**
     * @return bool
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function isSuperAdmin()
    {
        // return $this->id == 1;
        return (env('SUPER_ROLE') && in_array($this->id, range(1, 10)));
    }

    /**
     * @return bool
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function isActivationMobile(): bool
    {
        return $this->activation_type == UserActivationType::USER_ACTIVATION_MOBILE;
    }

    /**
     * @return bool
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function isActivationEmail(): bool
    {
        return $this->activation_type == UserActivationType::USER_ACTIVATION_EMAIL;
    }

    public function hasp($permission, $center)
    {
        $permission_record = Permission::findByName($permission);

        if($center instanceof Center)
        {
            $center = $center->id;
        }

        foreach($permission_record->roles as $role)
        {
            if($role->center_id == $center && $this->roles->contains($role->id))
            {
                return true;
            }
        }

        return false;
    }



    public function hasap($center, $permissions): bool
    {
        if(! is_array($permissions))
        {
            $permissions = [$permissions];
        }

        foreach ($permissions as $permission)
        {
            if ($this->hasp($permission, $center))
            {
                return true;
            }
        }

        return false;
    }

    public function rolesIDs($is_collection = false)
    {
        $ids = [];
        $this->roles->map(function($item) use (&$ids){
            $ids[] = $item->id;
        });
        $ids = array_values(array_unique($ids));

        if($is_collection)
        {
            $ids = collect($ids);
        }

        return $ids;
    }
}
