<?php

namespace App\Http\Controllers\User\Profile;

use App\Constants\Types\Center\CenterType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserRolesController extends Controller
{

    public function index()
    {
        $current_user = $this->currentUser();

        $records = $current_user
            ->roles()
            ->leftJoin('centers', 'roles.center_id', '=', 'centers.id')
            ->leftJoin('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->leftJoin('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->select(
                'roles.id as role_id',
                'roles.title as role_name',
                'centers.id as center_id',
                'centers.type as center_type',
                'centers.name as center_name',
                DB::raw('GROUP_CONCAT(permissions.title SEPARATOR " | ") as permissions_names')
            )
            ->orderBy('centers.name', 'ASC')
            ->orderBy('roles.title', 'ASC')
            ->groupBy(['roles.id', 'centers.id'])
            ->paginate(10)
            ;

        $records->map(function($record){
            if($record->center_name)
            {
                $record->center_full_name = CenterType::getValue($record->center_type) . " {$record->center_name}";
            }

            $record->permissions_names = Str::limit($record->permissions_names, 150);
        });

        $data = [
            'records' => $records,
        ];

        $this->breadcrumb();

        return view('users.profile.roles.index', $data);
    }

    /**
    * Set breadcrumb.
    */
   private function breadcrumb()
   {
       $breadcrumb = [
           [
               'title' => 'پروفایل',
               'link' => '#',
           ],
           [
               'title' => 'نقش‌های من',
               'link' => route('admin.profile.role.index'),
           ],
       ];

       $this->setBreadcrumb($breadcrumb);
   }
}
