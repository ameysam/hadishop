<?php

namespace App\Http\Controllers\Center\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Center\CenterMemberAddRequest;
use App\Http\Requests\User\MemberCenterRequest;
use App\Http\Responses\FailedResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Center;
use App\Models\CustomRole;
use App\Models\ModelHasRoles;
use App\Models\User;
use App\Services\Center\Admin\CenterService;
use App\Services\Grid\Grid;
use App\Services\User\Admin\MemberService;
use App\Services\User\Admin\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CenterMemberController extends Controller
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
    private $record;

    /**
     * @var Center
     */
    private $center;


    public function __construct(Center $center)
    {
        $this->center = $center;

        $this->middleware(["permission:center-edit"])->only('index', 'items');

        $this->middleware(["center-permission:center-edit,{$this->center->id}"])->only('delete');

        if($this->id = Router::getParam('id1'))
        {
            $this->record = User::with('roles')
                                // ->where('center_creator_id', $this->center->id)
                                // ->where(function($query){
                                //     $query->whereHas('roles', function($q){
                                //         $q->where('center_id', $this->center->id);
                                //     })
                                //     ->orWhere('center_creator_id', $this->center->id);
                                // })
                                ->findOrFail($this->id);
        }

        $this->breadcrumb();
    }


    public function index()
    {
        $currentUser = $this->currentUser();

        $records = ModelHasRoles::
                            join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                            ->rightJoin('users', 'model_has_roles.model_id', '=', 'users.id')
                            ->where(function($query){
                                $query
                                    ->where(function($query){
                                        $query
                                            ->where('roles.center_id', $this->center->id)
                                            ->whereNotIn('roles.slug', ['admin', 'user']);
                                    })
                                    ->orWhere('users.center_creator_id', $this->center->id);
                            })
                            ->where('users.id', '!=', $currentUser->id)
                            ->groupBy('users.id')
                            ->select(
                                'users.id as id',
                                'users.first_name as users_first_name',
                                'users.last_name as users_last_name',
                                'users.id_no as users_id_no',
                                'users.center_creator_id as users_center_creator_id',
                                DB::raw('GROUP_CONCAT(roles.title SEPARATOR " | ") as roles_title')
                            )
                            ->orderBy('id', 'desc')
                            ->paginate(12);

                            // return $records;
        $data = [
            'route_create_member' => route('admin.center.member.store', $this->center->id),
            'route_add_member' => route('admin.center.member.assign-role', $this->center->id),
            // 'route_remove_member' => route('admin.center.member.delete', $this->center->id),
            'roles' => $this->center->roles,
            'records' => $records,
        ];

        return view('centers.members.admin.index', $data);
    }

    public function store(MemberCenterRequest $request, MemberService $memberService, UserService $userService, CenterService $centerService)
    {
        return DB::transaction(function () use ($request, $memberService, $userService, $centerService) {

            $createdUser = $memberService
                ->setCenter($this->center)
                ->createRecord($request);

            if($roles_ids = $request['roles_ids'])
            {
                $userService->multiAssignRoles([$createdUser->id], $roles_ids);

                $roles = CustomRole::findMany($roles_ids);
                $roles->map(function($role) use ($centerService) {
                    if($role->isCenterAdmin())
                    {
                        $centerService->appendAdmins($this->center, $this->ids);
                    }
                });

                $this->center->users()->syncWithoutDetaching([$createdUser->id]);
            }

            return new SuccessResponse();
        });
    }

    public function show()
    {
        $data = [
            'record' => $this->record,
        ];

        return view('centers.members.admin.show', $data);
    }

    public function edit()
    {
        $data = [
            'record' => $this->record,
            // 'roles_ids' => $this->record->rolesIDs(),
            // 'roles' => $this->center->roles,
            'form' => [
                'method' => 'put',
                'action' => route('admin.center.member.update', [$this->center->id, $this->id]),
            ],
        ];

        return view('centers.members.admin.form', $data);
    }


    public function update(MemberCenterRequest $request, MemberService $memberService, UserService $userService, CenterService $centerService)
    {
        return DB::transaction(function () use ($request, $memberService, $userService, $centerService) {

            $createdUser = $memberService
                ->setCenter($this->center)
                ->updateRecord($this->record, $request);

            return new SuccessResponse();
        });
    }

    public function assignRole(CenterMemberAddRequest $request, UserService $userService, CenterService $centerService)
    {
        $members_ids = $request['members'];
        $roles_ids = $request['roles_id'];

        $userService->multiAssignRoles($members_ids, $roles_ids);

        $roles = CustomRole::findMany($roles_ids);
        $roles->map(function($role) use ($centerService) {
            if($role->isCenterAdmin())
            {
                $centerService->appendAdmins($this->center, $this->ids);
            }
        });

        $this->center->users()->syncWithoutDetaching($members_ids);

        return new SuccessResponse();
    }


    public function delete(CenterService $centerService)
    {
        $id = Router::getParam('id1');

        

        $currentUser = $this->currentUser();

        $deleteableUser = User::findOrFail($id);

        if($deleteableUser->isSuperAdmin())
        {
            return new FailedResponse('status', 'امکان حذف مدیر سایت وجود ندارد.');
        }
        if(! $currentUser->isSuperAdmin())
        {
            if($deleteableUser->hasRole("{$this->center->id}-admin-center"))
            {
                return new FailedResponse('status', 'امکان حذف مدیر مرکز وجود ندارد.');
            }
        }

        return DB::transaction(function () use ($id, $currentUser, $centerService) {

            ModelHasRoles::
                join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->join('users', 'model_has_roles.model_id', '=', 'users.id')
                ->where('roles.center_id', $this->center->id)
                ->where('users.id', $id)
                ->where('users.id', '!=', $currentUser->id)
                ->whereNotIn('roles.slug', ['admin', 'user'])
                ->delete();

            $centerService->appendAdmins($this->center, [$id]);

            $this->center->users()->detach([$id]);

            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

            return new SuccessResponse();
        });
    }


    /**
     * Set breadcrumb.
     */
    private function breadcrumb()
    {
        $action = Router::actionName();

        $breadcrumb = [
            [
                'title' => 'مراکز',
                'link' => route('admin.center.index'),
            ],
            [
                'title' => "اعضای «{$this->center->name}»",
                'link' => route('admin.center.member.index', $this->center->id),
            ],
        ];

        if($action == 'show')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->full_name,
                    'link' => route('admin.center.member.show', [$this->center->id, $this->record->id]),
                ];
        }
        else if($action == 'edit')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->full_name,
                    'link' => route('admin.center.member.show', [$this->center->id, $this->record->id]),
                ];
            $breadcrumb[] =
                [
                    'title' => 'ویرایش',
                    'link' => route('admin.center.member.edit', [$this->center->id, $this->record->id]),
                ];
        }
        $this->setBreadcrumb($breadcrumb);
    }
}
