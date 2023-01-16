<?php

namespace App\Http\Controllers\Center\Role\Admin;

use App\Constants\Types\Role\RoleType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Center\Role\RoleRequest;
use App\Http\Responses\SuccessResponse;
use App\Models\Center;
use App\Models\CustomRole;
use App\Models\PermissionTitle;
use App\Services\Grid\Grid;
use App\Services\Role\Admin\RoleService;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Role as ContractsRole;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
     * @var Center
     */
    private $center;

    /**
     * @var RoleService
     */
    private $roleService;


    public function __construct(Center $center, RoleService $roleService)
    {
        $this->center = $center;

        $this->roleService = $roleService;

        if($this->id = Router::getParam('id1'))
        {
            $this->record = Role::where('center_id', $this->center->id)->findOrFail($this->id);

            if(request()->isMethod('get'))
            {
                $this->record->type_fa = RoleType::getValue($this->record->type);
            }
        }
        if($ids = Router::getParam('ids'))
        {
            $this->ids = explode(',', $ids);
        }

        $this->middleware(["center-permission:role-add,{$this->center->id}"])->only('create', 'store');

        $this->middleware(["center-permission:role-show,{$this->center->id}"])->only('show', 'index', 'centerRoleSearch');

        $this->middleware(["center-permission:role-edit,{$this->center->id}"])->only('edit', 'update');

        $this->middleware(["center-permission:role-delete,{$this->center->id}"])->only('delete');

        $this->breadcrumb();
    }


    public function index()
    {
        $records = Role::where('center_id', $this->center->id)->paginate(12);

        foreach($records as $record)
        {
            $record->type_fa = RoleType::getValue($record->type);
        }

        $data = [
            'types' => RoleType::toJson(),
            'records' => $records,
        ];

        return view('centers.roles.admin.index', $data);
    }


    public function items(Grid $grid)
    {
        $records = Role::where('center_id', $this->center->id);

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
            'permissionTitles' => PermissionTitle::whereForCenter()->get(),
            'form' => [
                'method' => 'post',
                'action' => route('admin.center.role.store', $this->center->id),
            ],
        ];

        return view('centers.roles.admin.form', $data);
    }


    public function store(RoleRequest $request)
    {
        return DB::transaction(function () use ($request) {

            $request->merge(['type' => RoleType::ROLE_DYNAMIC]);

            $data = $this->roleService->preSave($request, $this->center);

            $this->roleService->createRecord($data);

            return new SuccessResponse();
        });
    }


    public function show()
    {
        $data = [
            'record' => $this->record,
            'permissionTitles' => PermissionTitle::whereForCenter()->get(),
        ];

        return view('centers.roles.admin.show', $data);
    }


    public function edit()
    {
        $data = [
            'record' => $this->record,
            'disable_edit' => $this->record->type == RoleType::ROLE_STATIC,
            'permissionTitles' => PermissionTitle::whereForCenter()->get(),
            'form' => [
                'method' => 'put',
                'action' => route('admin.center.role.update', [$this->center->id, $this->id]),
            ],
        ];

        return view('centers.roles.admin.form', $data);
    }


    public function update(RoleRequest $request)
    {
        return DB::transaction(function () use ($request) {

            $data = $this->roleService->preSave($request, $this->center);

            $this->roleService->updateRecord($this->record, $data);

            return new SuccessResponse();
        });
    }


    public function delete()
    {
        return DB::transaction(function () {

            Role::where('type', '!=', RoleType::ROLE_STATIC)->where('id', $this->id)->delete();

            return new SuccessResponse();
        });
    }

    public function centerRoleSearch(Request $request)
    {
        $keywords = $request->input('q', '.');

        $records = CustomRole::
            whereCenter($this->center)->
            where(function($query) use ($keywords){
                $query->
                    where('title', 'like', "%{$keywords}%")->
                    orWhere('slug', 'like', "%{$keywords}%");
            })->
            take(20)->
            get(['id', 'title']);

        $records->map(function($item){
            $item->name = $item->title;
        });

        return $records;
    }

    /**
     * Set breadcrumb.
     */
    private function breadcrumb()
    {
        $action = Router::actionName();

        $breadcrumb = [
            [
                'title' => $this->center->name,
                'link' => route('admin.center.show', $this->center->id),
            ],
            [
                'title' => "نقش‌های «{$this->center->name}»",
                'link' => route('admin.center.role.index', $this->center->id),
            ],
        ];

        if($action == 'create')
        {
            $breadcrumb[] =
                [
                    'title' => 'تعریف نقش جدید',
                    'link' => route('admin.center.role.create', $this->center->id),
                ];
        }
        else if($action == 'show')
        {
            $breadcrumb[] =
                [
                    'title' => 'نقش ' . ($this->record->title ? $this->record->title : 'مشاهده نقش'),
                    'link' => route('admin.center.role.show', [$this->center->id, $this->record->id]),
                ];
        }
        else if($action == 'edit')
        {
            $breadcrumb[] =
                [
                    'title' => 'نقش ' . ($this->record->title ? $this->record->title : 'مشاهده نقش'),
                    'link' => route('admin.center.role.show', [$this->center->id, $this->record->id]),
                ];
            $breadcrumb[] =
                [
                    'title' => 'ویرایش',
                    'link' => route('admin.center.role.edit', [$this->center->id, $this->record->id]),
                ];
        }
        $this->setBreadcrumb($breadcrumb);
    }
}
