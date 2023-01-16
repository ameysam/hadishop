<?php

namespace App\Http\Controllers\Center\Admin;

use App\Services\Center\Admin\CenterSaveService;
use App\Constants\Types\Center\CenterStatusType;
use App\Constants\Types\File\FileReasonType;
use App\Constants\Types\File\FileVisibilityType;
use App\Events\Center\CenterSaveEvent;
use App\Events\Center\CenterUpdateEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Center\CenterRequest;
use App\Http\Responses\SuccessResponse;
use App\Models\Center;
use App\Models\CenterType;
use App\Services\File\Src\FileSaveService;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CenterController extends Controller
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
     * @var Center
     */
    private $record;

    public function __construct()
    {
        $this->id = Router::getParam('cid') ?? (Router::getParam('ncid') ?? null);

        if($this->id)
        {
            $this->record = Center::with('files');
            if(Router::actionName('show'))
            {
                $this->record->with([
                    'rooms' => function($query){
                        $query->with('schedule');
                    }
                    ])->withCount('rooms');
            }
            $this->record = $this->record->findOrFail($this->id);

            if(!Router::isMethod('put'))
            {
                $this->record->admins = $this->record->getAdmins(['id', 'first_name', 'last_name', 'id_no']);
            }
        }

        if($ids = Router::getParam('ids'))
        {
            $this->ids = explode(',', $ids);
        }

        $this->middleware(["permission:center-list"])->only('index');
        $this->middleware(["permission:center-add"])->only('create', 'store');
        $this->middleware(["permission:center-show"])->only('show');
        $this->middleware(["center-permission:center-edit,{$this->id}"])->only('edit', 'update');

        $this->breadcrumb();
    }


    public function index()
    {
        $currentUser = $this->currentUser();

        $centers = Center::query();

        if(! $currentUser->isSuperAdmin())
        {
            $centers->whereHas('users', function($query) use ($currentUser){
                $query->where('users.id', $currentUser->id);
            });
        }
        $centers = $centers->with('type', 'files')->withCount('rooms')->get();

        // return
        $data = [
            'records' => $centers
        ];

        return view('centers.admin.index', $data);
    }


    public function create()
    {
        $data = [
            'center_types' => CenterType::all(),
            'center_statuses' => CenterStatusType::getValues(),
            'form' => [
                'action' => route('admin.center.store')
            ]
        ];

        return view('centers.admin.form', $data);
    }


    public function store(CenterRequest $request, CenterSaveService $centerSaveService, FileSaveService $fileSaveService)
    {
        return DB::transaction(function () use ($centerSaveService, $request, $fileSaveService) {
            $record = $centerSaveService->save($request);

            # Upload append files.
            if($request->hasFile('file'))
            {
                $files = $request->file('file');

                $fileSaveService
                    ->setDestination('public')
                    ->setFileableRecord($record)
                    ->setUser($this->currentUser())
                    ->setUploader($this->currentUser())
                    ->setReasonType(FileReasonType::FILE_REASON_LOGO)
                    ->setVisibilityType(FileVisibilityType::FILE_VISIBILITY_PUBLIC)
                    ->save($files);
            }

            // Make admin roles and assign to admin users
            CenterSaveEvent::dispatch($record);

            return new SuccessResponse();
        });
    }


    public function show()
    {
        $currentUser = $this->currentUser();
        // if(!$currentUser->isSuperAdmin())
        // {
        //     if(! in_array($currentUser->id, $this->record->admins_quick))
        //     {
        //         abort(403);
        //     }
        // }

        if(!empty($this->record->files[0]))
        {
            $this->record->file = $this->record->files[0];
        }

        // return
        $data = [
            'record' => $this->record,
        ];

        return view('centers.admin.show', $data);
    }

    public function edit()
    {
        $currentUser = $this->currentUser();
        if(!$currentUser->isSuperAdmin())
        {
            if(! in_array($currentUser->id, $this->record->admins_quick))
            {
                abort(403);
            }
        }

        if(!empty($this->record->files[0]))
        {
            $this->record->file = $this->record->files[0];
        }

        $data = [
            'record' => $this->record,
            'center_types' => CenterType::all(),
            'center_statuses' => CenterStatusType::getValues(),
            'form' => [
                'action' => route('admin.center.update', $this->id),
                'method' => 'put'
            ]
        ];

        return view('centers.admin.form', $data);
    }

    public function update(CenterRequest $request, CenterSaveService $centerSaveService, FileSaveService $fileSaveService)
    {
        $currentUser = $this->currentUser();
        if(! $currentUser->isSuperAdmin())
        {
            if(! in_array($currentUser->id, $this->record->admins_quick))
            {
                abort(403);
            }
        }

        $old_admin_ids = $this->record->admins_quick ?? [];

        return DB::transaction(function () use ($centerSaveService, $request, $fileSaveService, $old_admin_ids) {
            $record = $centerSaveService->setRecord($this->record)->save($request);

            # Upload append files.
            if($request->hasFile('file'))
            {
                $files = $request->file('file');

                $this->record->files()->delete();

                $fileSaveService
                    ->setDestination('public')
                    ->setFileableRecord($record)
                    ->setUser($this->currentUser())
                    ->setUploader($this->currentUser())
                    ->setReasonType(FileReasonType::FILE_REASON_LOGO)
                    ->setVisibilityType(FileVisibilityType::FILE_VISIBILITY_PUBLIC)
                    ->save($files);
            }
            else if($request['delete_photo'])
            {
                $this->record->files()->delete();
            }

            // Detach old admin roles and assign admin roles to new admin users
            CenterUpdateEvent::dispatch($record, $old_admin_ids);

            return new SuccessResponse();
        });
    }

    public function roles()
    {
        $query = Role::query();

        if($this->record)
        {
            $query->where('center_id', $this->record->id);
        }
        else
        {
            $query->whereNull('center_id');
        }

        return new SuccessResponse('status', null, ['data' => $query->get(['title', 'id'])]);
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
        ];

        if($action == 'create')
        {
            $breadcrumb[] =
                [
                    'title' => 'تعریف مرکز جدید',
                    'link' => route('admin.center.create'),
                ];
        }
        else if($action == 'show')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->name ? $this->record->name : 'مشاهده مرکز',
                    'link' => route('admin.center.show', $this->record->id),
                ];
        }
        else if($action == 'edit')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->name ? $this->record->name : 'مشاهده مرکز',
                    'link' => route('admin.center.show', $this->record->id),
                ];
            $breadcrumb[] =
                [
                    'title' => 'ویرایش',
                    'link' => route('admin.center.edit', $this->record->id),
                ];
        }
        $this->setBreadcrumb($breadcrumb);
    }
}
