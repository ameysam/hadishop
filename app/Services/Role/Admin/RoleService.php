<?php

namespace App\Services\Role\Admin;

use App\Constants\Types\Permission\PermissionType;
use App\Constants\Types\Role\RoleType;
use App\Models\Center;
use App\Models\CenterSection;
use App\Models\User;
use App\Services\Contracts\Service;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleService extends Service
{

    /**
     * preSave
     * Prepare objects before save.
     *
     * @param Request $data
     * @return array
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function preSave(Request $request)
    {
        return [
            'slug' => $request['slug'],
            'name' => isset($center) ? "{$center}-{$request['slug']}" : $request['slug'],
            'title' => $request['title'],
            'type' => $request['type'],
            'permissions' => $request['permissions'],
            'guard_name' => $request['guard_name'] ?? 'web',
        ];
    }


    /**
     * createRecord
     * Find or create a role. If set permissions on parameters of the method or set in the $data array, save permissions for the role.
     *
     * @param array $data
     * @param array $permissions
     * @return Role
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function createRecord($data, array $permissions = null)
    {
        if($permissions == null && !empty($data['permissions']))
        {
            $permissions = $data['permissions'];
            unset($data['permissions']);
        }

        $role = Role::firstOrCreate(['name' => $data['name']] , $data);

        if($permissions)
        {
            if($permissions == ['*'])
            {
                $permissions = Permission::all();
            }

            $role->syncPermissions($permissions);
        }

        return $role;
    }

    /**
     * updateRecord
     * @param CenterSection $record
     * @return CenterSection
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function updateRecord(Role $record, array $data, array $permissions = null)
    {
        if($permissions == null && !empty($data['permissions']))
        {
            $permissions = $data['permissions'];
            unset($data['permissions']);
        }

        if($record->type == RoleType::ROLE_STATIC)
        {
            unset($data['name'], $data['slug'], $data['title'], $data['center']);
        }

        if(! $data['type'])
        {
            $data['type'] = $record->type;
        }

        // dd($data);
        $record->update($data);

        $record->syncPermissions($permissions);

        return $record;
    }


    /**
     * centerAdminRole
     * @param Center $center
     * @return Role
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function makeCenterAdminRole(Center $center)
    {
        $role = $center->roles()->where([
            'name' => $center->adminRoleName(),
            'slug' => str_replace("{$center->id}-", "", $center->adminRoleName()),
        ])->first();

        if(! $role)
        {
            $role = $center->roles()->create([
                'name' => $center->adminRoleName(),
                'slug' => str_replace("{$center->id}-", "", $center->adminRoleName()),
                'title' => "مدیر {$center->type_fa} {$center->name}",
                'guard_name' => 'web',
                'type' => RoleType::ROLE_STATIC,
                ]);

            $role->givePermissionTo(Permission::where('type', PermissionType::PERMISSION_CENTER)->get());
        }

        return $role;
    }


    /**
     * getUsersHasPermissions
     * Get all users that has one of the permissions in the center;
     *
     * @param array|string $permissions
     * @param Center|int $center
     * @return Collection
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function getUsersHasPermissions($permissions, $centers = null)
    {
        $roles = Role::query();

        if($centers)
        {
            $centers_ids = [];
            $centers->map(function($center) use (&$centers_ids) {
                $centers_ids[] = $center->id;
            });

            $roles->whereIn('center_id', $centers_ids);
        }

        if(! is_array($permissions))
        {
            $permissions = [$permissions];
        }

        $roles = $roles
            ->whereHas('permissions', function($q) use ($permissions){
                $q->whereIn('name', $permissions);
            })
            ->get();

        $users = collect([]);

        $roles->map(function($record) use (&$users, $centers){
            $record->users->map(function($user) use (&$users, $record, $centers){

                $unreads = $centers->firstWhere('id', $record->center_id)->unread_visits ?? 0;

                $user->unread_online_visit_count = $unreads;

                if(!$users->contains('id', $user->id))
                {
                    $users->push($user);
                }
                else
                {
                    $users->firstWhere('id', $user->id)->unread_online_visit_count += $unreads;
                }
            });
        });

        return $users;
    }



    /**
     * getUserCentersByPermissions
     * Fetch and return centers of the user by specific permissions
     *
     * @param User $user
     * @param array $permissions
     * @return array
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function getUserCentersByPermissions(User $user, array $permissions)
    {
        $centers_ids = [];

        $user->roles->map(function($role) use ($permissions, &$centers_ids) {
            $role->permissions->map(function($permission) use ($permissions, &$centers_ids, $role) {
                if(in_array($permission->name, $permissions))
                {
                    if($role->center_id)
                    {
                        $centers_ids[] = ($role->center_id);
                    }
                }
            });
        });

        return [
            'records' => Center::orderByName()->findMany($centers_ids),
            'ids' => array_values(array_unique($centers_ids)),
        ];
    }
}
