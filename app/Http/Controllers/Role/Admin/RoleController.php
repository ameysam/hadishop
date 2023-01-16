<?php

namespace App\Http\Controllers\Role\Admin;

use App\Constants\Types\Role\RoleType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleRequest;
use App\Http\Responses\SuccessResponse;
use App\Models\Center;
use App\Models\CustomRole;
use App\Models\PermissionTitle;
use App\Services\Grid\Grid;
use App\Services\Role\Admin\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Role as ContractsRole;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Services\Center\Self\CSSService;
use Illuminate\Routing\Router;

class RoleController extends Controller
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
     * @var Role
     */
    private $record;

    /**
     * @var RoleService
     */
    private $roleService;


    /**
     * @var CSSService
     */
    private $cssService;


    public function __construct(RoleService $roleService)
    {

        $this->roleService = $roleService;

        if($this->id = Router::getParam('id'))
        {
            $this->record = CustomRole::findOrFail($this->id);

            if(request()->isMethod('get'))
            {
                $this->record->type_fa = RoleType::getValue($this->record->type);
            }
        }
        if($ids = Router::getParam('ids'))
        {
            $this->ids = explode(',', $ids);
        }

        $this->middleware(["permission:role-add"])->only('create', 'store');

        $this->middleware(["permission:role-show"])->only('show', 'index', 'items');

        $this->middleware(["permission:role-edit"])->only('edit', 'update');

        $this->middleware(["permission:role-delete"])->only('delete');

        $this->breadcrumb();
    }


    public function index()
    {
        $data = [
            'route_items' => route('admin.role.items'),
            'route_index' => route('admin.role.index'),
            'types' => RoleType::toJson(),
            'centers' => Center::getAllItemsForDropdown(),
        ];

        return view('roles.admin.index', $data);
    }


    public function items(Grid $grid)
    {
        $records = CustomRole::with('center');

        $records = $grid->items($records);

        $records['rows'] = $records['rows']->each(function ($item) {
            // $item->created_at_farsi = jdate($item->created_at_fa)->format('Y/m/d');
            $item->created_at_farsi = jdate($item->created_at)->format('Y/m/d');
            $item->type_fa = RoleType::getValue($item->type);
        });

        return $records;
    }

    public function create()
    {
        $data = [
            'permissionTitles' => PermissionTitle::all(),
            'centers' => Center::orderBy('name')->get(),
            'role_types' => RoleType::getValues(),
            'form' => [
                'method' => 'post',
                'action' => route('admin.role.store'),
            ],
        ];

        return view('roles.admin.form', $data);
    }


    public function store(RoleRequest $request)
    {
        return DB::transaction(function () use ($request) {

            $data = $this->roleService->preSave($request, $request['center_id']);

            $this->roleService->createRecord($data);

            return new SuccessResponse();
        });
    }


    public function show()
    {
        $data = [
            'record' => $this->record,
            'permissionTitles' => PermissionTitle::all(),
        ];

        return view('roles.admin.show', $data);
    }


    public function edit()
    {
        $data = [
            'record' => $this->record,
            'permissionTitles' => PermissionTitle::all(),
            'centers' => Center::orderBy('name')->get(),
            'role_types' => RoleType::getValues(),
            'form' => [
                'method' => 'put',
                'action' => route('admin.role.update', $this->id),
            ],
        ];

        return view('roles.admin.form', $data);
    }


    public function update(RoleRequest $request)
    {
        return DB::transaction(function () use ($request) {

            $data = $this->roleService->preSave($request, $request['center_id']);

            $this->roleService->updateRecord($this->record, $data);

            return new SuccessResponse();
        });
    }


    public function delete()
    {
        return DB::transaction(function () {

            Role::destroy($this->ids);

            return new SuccessResponse('ok');
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
                'title' => "نقش‌ها",
                'link' => '#',
            ],
        ];

        if($action == 'create')
        {
            $breadcrumb[] =
                [
                    'title' => 'تعریف نقش جدید',
                    'link' => route('admin.role.create'),
                ];
        }
        else if($action == 'show')
        {
            $breadcrumb[] =
                [
                    'title' => "نقش «{$this->record->title}»",
                    'link' => route('admin.role.show', $this->record->id),
                ];
        }
        else if($action == 'edit')
        {
            $breadcrumb[] =
                [
                    'title' => "نقش «{$this->record->title}»",
                    'link' => route('admin.role.show', $this->record->id),
                ];
            $breadcrumb[] =
                [
                    'title' => 'ویرایش',
                    'link' => route('admin.role.edit', $this->record->id),
                ];
        }
        $this->setBreadcrumb($breadcrumb);
    }
}
