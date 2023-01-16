<?php

namespace App\Http\Controllers\User\Admin;

use App\Constants\Types\User\UserActivationStatusType;
use App\Constants\Types\User\UserActivationType;
use App\Constants\Types\User\UserGenderType;
use App\Constants\Types\User\UserRegisterStatusType;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserAdminRequest;
use App\Http\Responses\SuccessResponse;
use App\Models\Center;
use App\Models\CustomRole;
use App\Models\User;
use App\Services\Center\Admin\CenterService;
use App\Services\Grid\Grid;
use App\Services\Province\Admin\ProvinceService;
use App\Services\User\Admin\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $userService;

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

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        if($this->id = Router::getParam('id'))
        {
            $this->record = User::findOrFail($this->id);
        }
        if($ids = Router::getParam('ids'))
        {
            $this->ids = explode(',', $ids);
        }

        // $this->middleware(["mypermission:role-add,{$this->center->id}"])->only('create', 'store');

        // $this->middleware(["mypermission:role-show,{$this->center->id}"])->only('show', 'index', 'items');

        // $this->middleware(["mypermission:role-edit,{$this->center->id}"])->only('edit', 'update');

        // $this->middleware(["mypermission:role-delete,{$this->center->id}"])->only('delete');

        $this->breadcrumb();
    }

    public function index()
    {
        $data = [
            'route_items' => route('admin.user.items'),
            'route_index' => route('admin.user.index'),
            'genders' => UserGenderType::toJson(),
            'activation_types' => UserActivationType::toJson(),
            'activation_statuses' => UserActivationStatusType::toJson(),
        ];

        return view('users._self.admin.index', $data);
    }


    public function items(Grid $grid)
    {
        $records = User::with('province:id,title','city:id,title');

        $records = $grid->items($records);

        $records['rows'] = $records['rows']->each(function ($item) {
            $item->birthdate_farsi = $item->birthdate ? jdate($item->birthdate)->format('Y/m/d') : '';
            $item->created_at_farsi = jdate($item->created_at)->format('Y/m/d');
            $item->activation_status_farsi = $item->activation_status_fa;
            $item->activation_type_farsi = $item->activation_type_fa;
            $item->gender_farsi = $item->gender_fa;
        });

        return $records;
    }


    public function create()
    {
        $data = [
            'form' => [
                'method' => 'post',
                'action' => route('admin.user.store'),
            ],
            'activation_types' => UserActivationType::getValues(),
            'activation_statuses' => UserActivationStatusType::getValues(),
        ];

        return view('users._self.admin.form', $data);
    }


    public function store(UserAdminRequest $request)
    {
        return DB::transaction(function () use ($request) {

            $this->userService->createRecord($request);

            return new SuccessResponse();
        });
    }


    public function show()
    {
        $data = [
            'record' => $this->record,
        ];

        return view('users._self.admin.show', $data);
    }


    public function edit(ProvinceService $provinceService)
    {
        // if($this->record->birthdate)
        // {
        //     $gregorian_sections = $this->record->birthdate->format('Y-m-d');
        //     $this->record->gregorian_sections = explode('-', $gregorian_sections);

        //     $jalali_sections = jdate($this->record->birthdate)->format('Y-m-d');
        //     $this->record->jalali_sections = explode('-', $jalali_sections);
        // }

        $data = [
            'record' => $this->record,
            'form' => [
                'method' => 'put',
                'action' => route('admin.user.update', $this->id),
            ],
            'activation_types' => UserActivationType::getValues(),
            'activation_statuses' => UserActivationStatusType::getValues(),
        ];

        return view('users._self.admin.form', $data);
    }


    public function update(UserAdminRequest $request)
    {
        return DB::transaction(function () use ($request) {

            $this->userService->updateRecord($this->record, $request);

            return new SuccessResponse();
        });
    }


    public function softDelete()
    {
        $records = User::withTrashed()->findMany($this->ids, ['id', 'deleted_at']);

        return DB::transaction(function () use ($records) {

            $this->userService->destroyMulti($records);

            return new SuccessResponse('ok');
        });
    }


    public function forceDelete()
    {
        $this->userService->forceDelete($this->ids, User::class);

        return new SuccessResponse('ok');
    }

    public function assignRoles(Request $request, CenterService $centerService)
    {
        $this->validate($request, [
            'roles_id' => 'required|array',
            'roles_id.*' => 'required|exists:roles,id',
            'center_id' => 'nullable|exists:centers,id',
        ], [], [
            'roles_id' => 'نقش(ها)',
            'centers' => 'مرکز',
        ]);

        $roles_ids = $request['roles_id'];

        $center = null;
        if($request['center_id'])
        {
            $center =  Center::findOrFail($request['center_id']);
        }

        $roles = CustomRole::findMany($roles_ids);

        return DB::transaction(function () use ($roles_ids, $center, $centerService, $roles) {

            $result = $this->userService->multiAssignRoles($this->ids, $roles_ids);

            if($center)
            {
                $roles->map(function($role) use ($centerService, $center) {
                    if($role->isCenterAdmin())
                    {
                        $centerService->appendAdmins($center, $this->ids);
                    }
                });
            }

            return new SuccessResponse();
        });

        // $roles_ids = $request['roles_id'];

        // return DB::transaction(function () use ($roles_ids) {

        //     $result = $this->userService->multiAssignRoles($this->ids, $roles_ids);

        //     return new SuccessResponse();
        // });
    }

    /**
     * Set breadcrumb.
     */
    private function breadcrumb()
    {
        $action = Router::actionName();

        $breadcrumb = [
            [
                'title' => 'کاربران',
                'link' => '#',
            ],
            [
                'title' => 'فهرست کاربران',
                'link' => route('admin.user.index'),
            ],
        ];

        if($action == 'create')
        {
            $breadcrumb[] =
                [
                    'title' => 'تعریف کاربر جدید',
                    'link' => route('admin.user.create'),
                ];
        }
        else if($action == 'show')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->full_name ? $this->record->full_name : 'مشاهده کاربر',
                    'link' => route('admin.user.show', $this->record->id),
                ];
        }
        else if($action == 'edit')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->full_name ? $this->record->full_name : 'مشاهده کاربر',
                    'link' => route('admin.user.show', $this->record->id),
                ];
            $breadcrumb[] =
                [
                    'title' => 'ویرایش',
                    'link' => route('admin.user.edit', $this->record->id),
                ];
        }
        $this->setBreadcrumb($breadcrumb);
    }
}
