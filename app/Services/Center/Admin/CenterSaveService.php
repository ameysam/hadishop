<?php

namespace App\Services\Center\Admin;

use App\Constants\Types\Center\CenterStatusType;
use App\Models\Center;
use App\Models\CenterType;
use App\Services\Role\Admin\RoleService;
use App\Services\User\Admin\UserService;
use Illuminate\Support\Facades\Auth;

class CenterSaveService
{
    private $center;

    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * @var UserService
     */
    private $userService;


    /**
     * __construct
     * @param ProvinceService $provinceService
     * @return void
     */
    public function __construct(RoleService $roleService, UserService $userService)
    {
        $this->roleService = $roleService;

        $this->userService = $userService;
    }

    public function setRecord(Center $center)
    {
        $this->center = $center;
        return $this;
    }


    public function getRecord()
    {
        return $this->center;
    }


    public function save($request)
    {
        // $currentUser = Auth::user();

        $admins = $request['admins'];
        if(!is_array($admins))
        {
            $admins = [];
        }
        // $admins[] = $currentUser->id . "";
        $admins = array_unique($admins);

        if(!$this->center)
        {
            $this->center = new Center();
        }

        $type_id = $request['type_id'];
        $typeRecord = CenterType::firstOrCreate(
            ['id' => $type_id],
            ['name' => $type_id]
        );

        $this->center->name = $request['name'];

        $this->center->type_id = $typeRecord->id;

        $this->center->status = $request['status'];

        $this->center->address = $request['address'];
        $this->center->contacts = $request['contacts'];

        $this->center->lat = $request['lat'];
        $this->center->lng = $request['lng'];

        $this->center->admins_quick = $admins;

        $this->center->save();

        $this->center->users()->sync($admins);

        return $this->center;
    }
}
