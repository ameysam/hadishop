<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use App\Models\Center;
use App\Models\CenterType;
use App\Models\CustomRole;
use App\Models\ModelHasRoles;
use App\Models\User;
use App\Services\Center\Admin\CenterService;
use App\Services\Grid\Grid;
use App\Services\Role\Admin\StaticRoleService;
use App\Services\User\Admin\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $ids;

    /**
     * @var User
     */
    private $user;


    public function __construct()
    {
        if($this->id = Router::getParam('id'))
        {
            $this->user = User::findOrFail($this->id);
        }
        if($ids = Router::getParam('ids'))
        {
            $this->ids = explode(',', $ids);
        }

        $this->breadcrumb();
    }


    public function index()
    {
        $data = [
            'route_items' => route('admin.user.role.items', $this->user->id),
            'route_index' => route('admin.user.role.index', $this->user->id),
            'user' => $this->user,
        ];

        return view('users.role.admin.index', $data);
    }


    public function items(Grid $grid)
    {
        $records = ModelHasRoles::
            where('model_type', 'App\\Models\\User')
            ->where('model_id', $this->user->id)
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->leftJoin('centers', 'roles.center_id', '=', 'centers.id')
            ->leftJoin('center_types', 'centers.type_id', '=', 'center_types.id')
            ->select(
                'model_has_roles.id as id',
                'center_types.name as center_type',
                'centers.name as center_name',
                'roles.title as role_title'
            );

        $records = $grid->items($records);

        $records['rows'] = $records['rows']->each(function ($item) {
            $item->center_full_name = "{$item->center_type} {$item->center_name}";
        });

        return $records;
    }


    public function assignRoles(Request $request, UserService $userService, CenterService $centerService)
    {
        $this->validate($request, [
            'roles_id' => 'required|array',
            'roles_id.*' => 'required|exists:roles,id',
            'center_id.*' => 'required|exists:centers,id',
        ], [], [
            'roles_id' => 'نقش(ها)',
            'centers' => 'مرکز',
        ]);

        $roles_ids = $request['roles_id'];

        $center =  Center::findOrFail($request['center_id']);

        $roles = CustomRole::findMany($roles_ids);

        return DB::transaction(function () use ($roles_ids, $userService, $center, $centerService, $roles) {

            $result = $userService->multiAssignRoles([$this->id], $roles_ids);

            $roles->map(function($role) use ($centerService, $center) {
                if($role->isCenterAdmin())
                {
                    $centerService->appendAdmins($center, [$this->id]);
                }
            });

            return new SuccessResponse();
        });
    }



    public function delete(CenterService $centerService)
    {
        return DB::transaction(function () use ($centerService){

            $records = ModelHasRoles::findMany($this->ids);

            $records->map(function($record) use ($centerService){
                if($record->role->slug == "admin-place")
                {
                    $centerService->deappendAdmins($record->role->center, [$record->model_id]);
                }
            });

            ModelHasRoles::destroy($this->ids);

            return new SuccessResponse('ok');
        });
    }


    /**
     * Set breadcrumb.
     */
    private function breadcrumb()
    {
        $breadcrumb = [
            [
                'title' => 'کاربران',
                'link' => '#',
            ],
            [
                'title' => 'فهرست کاربران',
                'link' => route('admin.user.index'),
            ],
            [
                'title' => "نقش‌های «" . ($this->user->full_name ? $this->user->full_name : 'کاربر') . "»",
                'link' => route('admin.user.role.index', $this->user->id),
            ],
        ];

        $this->setBreadcrumb($breadcrumb);
    }
}
