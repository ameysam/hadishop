<?php

namespace App\Services\User\Admin;

use App\Constants\Types\User\UserNationalityType;
use App\Constants\Types\User\UserRegisterStatusType;
use App\Models\Center;
use App\Models\Month;
use App\Models\User;
use App\Services\Contracts\Service;
use App\Services\DateTime\DateTimeService;
use App\Services\Image\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserService extends Service
{

    public function syncRole(User $user, array $roles)
    {
        $user->assignRole($roles);

        return $user;
    }


    public function multiSyncRole(array $users_ids, array $roles)
    {
        $users = User::findMany($users_ids);

        foreach($users as $user)
        {
            $this->syncRole($user, $roles);
        }

        return true;
    }

    public function multiAssignRoles(array $users_ids, array $roles)
    {
        $users = User::findMany($users_ids);

        foreach($users as $user)
        {
            $this->syncRole($user, $roles);
        }

        return true;
    }


    public function multiDetachRole(array $users_ids, $role)
    {
        $users = User::findMany($users_ids);

        foreach($users as $user)
        {
            if(is_array($role))
            {
                foreach($role as $role_item)
                {
                    $user->removeRole($role_item);
                }
            }
            else
            {
                $user->removeRole($role);
            }
        }

        return true;
    }


    /**
     * searchUsersByName
     * @param string|null $keyword
     * @param array $fields
     * @param int $limit
     * @return Illuminate\Database\Eloquent\Collection
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function searchUsersByName(string $keyword = null, array $fields = ['*'], int $limit = 10)
    {
        $query = User::where('first_name', 'like', "%{$keyword}%")
                        ->orWhere('last_name', 'like', "%{$keyword}%")
                        ->orWhere('id_no', 'like', "%{$keyword}%");

        $records = $query
            ->take($limit)
            ->get($fields);

        return $records;
    }

    /**
     * Get centers of the user.
     *
     * @param User $user
     * @return mixed
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function centers(User $user)
    {
        if($user->isSuperAdmin())
        {
            $query = "SELECT * FROM `centers` WHERE `deleted_at` IS NULL ORDER BY `centers`.`name` ASC";
        }
        else
        {
            $query = "SELECT `centers`.*
                        FROM `roles`
                        JOIN `centers` on `roles`.`center_id` = `centers`.`id`
                        WHERE `deleted_at` IS NULL
                        AND `roles`.`id` IN ( SELECT `role_id` FROM `model_has_roles` WHERE `model_id` = {$user->id})
                        GROUP BY `centers`.`id`
                        ORDER BY `centers`.`name` ASC
                        ";
        }

        $records = DB::select($query);

        return Center::hydrate($records);
    }


    public function createRecord(Request $request)
    {
        $data = [
            'id_no' => $request['id_no'],
            'mobile_no' => $request['mobile_no'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'province_id' => $request['province_id'],
            'city_id' => $request['city_id'],
            'email' => $request['email'],
            'gender' => $request['gender'],
            'activation_status' => $request['activation_status'],
            'activation_type' => $request['activation_type'],
            'birthdate' => $birthdate ?? null,
            'password' => $request['password'],
        ];

        $user = User::create($data);

        // $image = $request['image'] ? ImageService::makeFromBase64($request['image'], $user) : null;

        // $user->image = $image;
        // $user->save();

        return $user;
    }

    public function updateRecord(User $user, Request $request)
    {
        $data = [
            'id_no' => $request['id_no'],
            'mobile_no' => $request['mobile_no'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'province_id' => $request['province_id'],
            'city_id' => $request['city_id'],
            'gender' => $request['gender'],
            'activation_status' => $request['activation_status'],
            'activation_type' => $request['activation_type'],
            'birthdate' => $birthdate ?? null,
        ];

        if($request['password'])
        {
            $data['password'] = $request['password'];
        }

        $user->update($data);

        return $user;
    }

    public function forceDelete(array $ids, string $model)
    {
        return $model::withTrashed()->whereIn('id', $ids)->where('id', '>', 10)->forceDelete();
    }
}
