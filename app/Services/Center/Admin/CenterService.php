<?php

namespace App\Services\Center\Admin;

use App\Models\Center;
use App\Models\User;
use App\Services\Contracts\Service;
use App\Services\Province\Admin\ProvinceService;
use App\Services\Role\Admin\RoleService;
use App\Services\Role\Admin\StaticRoleService;
use App\Services\User\Admin\UserService;
use Illuminate\Support\Facades\Auth;

class CenterService extends Service
{
    /**
     * @var ProvinceService
     */
    private $provinceService;

    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var StaticRoleService
     */
    private $staticRoleService;

    /**
     * __construct
     * @param ProvinceService $provinceService
     * @return void
     */
    public function __construct(ProvinceService $provinceService, RoleService $roleService, UserService $userService, StaticRoleService $staticRoleService)
    {
        $this->provinceService = $provinceService;

        $this->roleService = $roleService;

        $this->userService = $userService;

        $this->staticRoleService = $staticRoleService;
    }

    /**
     * preSave
     * Prepare objects before save.
     *
     * @param mixed $data
     * @param Center|null $center
     * @return array
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function preSave($data, Center $center = null)
    {
        $current_user = Auth::user();

        $old_admins_ids = null;

        if(! $center)
        {
            $center = new Center();
        }
        else
        {
            $old_admins_ids = $center->admins->pluck('id')->toArray();

            unset($center->admins);
        }

        /* Check city selected in the form */
        if(!empty($data['city_id']))
        {
            $city = $this->provinceService->getCity($data['city_id']);

            $center->city_id = $data['city_id'];

            $center->city_name = $city->title;
        }

        /* Check province selected in the form */
        if(!empty($data['province_id']))
        {
            $province = $this->provinceService->getProvince($data['province_id']);

            $center->province_id = $data['province_id'];

            $center->province_name = $province->title;
        }

        $admin_ids = null;
        /* Get admins ids */
        if(!empty($data['admins']))
        {
            $admin_ids = $data['admins'];
        }

        

        $center->admins_quick = $admin_ids;

        $center->name = $data['name'];

        $center->name_en = $data['name_en'];

        $center->type = $data['type'];

        $center->status = $data['status'];

        $center->address = $data['address'];

        $center->phones = $data['phones'];

        $center->lat = $data['lat'];

        $center->lng = $data['lng'];

        $center->description = $data['description'];

        if($current_user->isSuperAdmin())
        {
            $center->coopration_percent = $data['coopration_percent'];
        }

        return [
            'center' => $center,
            'admins' => $admin_ids,
            'old_admins' => $old_admins_ids,
        ];
    }


    /**
     * createRecord
     * @param Center $record
     * @return Center
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function createRecord(Center $record, array $admin_ids = null, array $supporter_ids = null)
    {
        $record->save();

        # Make the center admin role
        $admin_role = $this->roleService->makeCenterAdminRole($record);

        # Attach admin role to admins
        if($admin_ids)
        {
            $this->userService->multiSyncRole($admin_ids, [$admin_role->id]);
        }


        # Make the center static roles
        $static_roles = $this->staticRoleService->makeCenterAllStaticRoles($record);

        # Attach Supporter role to supporters of the center
        if($supporter_ids)
        {
            $this->userService->multiSyncRole($supporter_ids, [$static_roles['supporter']->id]);
        }

        return $record;
    }


    /**
     * createRecord
     * @param Center $record
     * @return Center
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function updateRecord(Center $record, array $admin_ids = null, array $old_admins_ids = null, array $supporters_ids = null, array $old_supporters_ids = null)
    {
        $record->save();

        # Detach center admin role from old admins
        if($old_admins_ids)
        {
            $this->userService->multiDetachRole($old_admins_ids, $record->adminRoleName());
        }

        # Attach admin role to admins
        if($admin_ids)
        {
            $this->userService->multiSyncRole($admin_ids, [$record->adminRoleName()]);
        }



        # Make the center static roles
        $static_roles = $this->staticRoleService->makeCenterAllStaticRoles($record);

        # Detach center admin role from old admins
        if($old_supporters_ids)
        {
            $this->userService->multiDetachRole($old_supporters_ids, $static_roles['supporter']->id);
        }

        # Attach Supporter role to supporters of the center
        if($supporters_ids)
        {
            $this->userService->multiSyncRole($supporters_ids, [$static_roles['supporter']->id]);
        }

        return $record;
    }



    public function attachAdmins(Center $center, array $admin_ids)
    {
        if($center->admins_quick)
        {
            # Detach old users admin roles
            $this->userService->multiDetachRole($center->admins_quick, $center->adminRoleName());
        }

        # Attach admin role to new admins
        $this->userService->multiSyncRole($admin_ids, [$center->adminRoleName()]);

        return $center;
    }

    public function appendAdmins(Center $center, array $admin_ids)
    {
        if($center->admins_quick)
        {
            $admins = $center->admins_quick;

            foreach($admin_ids as $admin_id)
            {
                if(! in_array($admin_id, $admins))
                {
                    $admins[] = $admin_id;
                }
            }
        }
        else
        {
            $admins = $admin_ids;
        }

        $center->admins_quick = $admins;
        $center->save();

        return $center;
    }


    public function deappendAdmins(Center $center, array $admin_ids)
    {
        if($center->admins_quick)
        {
            $admins = collect($center->admins_quick);
            $admins = $admins->reject(function($value, $key) use ($admin_ids){
                return in_array($value, $admin_ids);
            });

            $center->admins_quick = array_values($admins->toArray());
            $center->save();
        }

        return $center;
    }


    public function getAdmins(Center $center, array $fields = ['*'])
    {
        return User::findMany($center->admins_quick, $fields);
    }


    public function getSupporters(Center $center, array $fields = ['*'])
    {
        return User::findMany($center->supporters_quick, $fields);
    }
}
