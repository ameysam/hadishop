<?php

namespace App\Http\Controllers\Schedule\Admin;

use App\Constants\Types\Room\RoomType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Schedule\ScheduleRequest;
use App\Http\Responses\FailedResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Center;
use App\Models\Schedule;
use App\Services\Schedule\Admin\ScheduleSaveService;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Schedule
     */
    private $record;

    /**
     * @var array
     */
    private $ids;

    /**
     * @var Center
     */
    private $center;

    public function __construct(Center $center)
    {
        $this->center = $center;

        $this->id = Router::getParam('id1');

        if($this->id)
        {
            $this->record = Schedule::whereCenter($this->center)->findOrFail($this->id);
        }
        if($ids = Router::getParam('ids'))
        {
            $this->ids = explode(',', $ids);
        }

        $this->middleware(["center-permission:schedule-list,{$this->center->id}"])->only('index');
        $this->middleware(["center-permission:schedule-add,{$this->center->id}"])->only('create', 'store');
        $this->middleware(["center-permission:schedule-edit,{$this->center->id}"])->only('edit', 'update');
        $this->middleware(["center-permission:schedule-show,{$this->center->id}"])->only('show');
        $this->middleware(["center-permission:schedule-delete,{$this->center->id}"])->only('delete');

        $this->breadcrumb();
    }


    public function index()
    {
        // return
        $records = Schedule::whereCenter($this->center)
                        ->with([
                            'rooms' => function($q){
                                $q->select('id','name','schedule_id')->take(3);
                            }
                            ])
                        ->latest()
                        ->get();

        $data = [
            'records' => $records,
        ];

        return view('centers.schedules.admin.index', $data);
    }


    public function create()
    {
        $data = [
            'room_types' => RoomType::getValues(),
            'hours' => Arr::getDailyHours(),
            'minutes' => Arr::getDailyMinutes(),
            'details_disable' => [],
            'form' => [
                'action' => route('admin.center.schedule.store', $this->center->id)
            ]
        ];

        return view('centers.schedules.admin.form', $data);
    }


    public function store(ScheduleRequest $request, ScheduleSaveService $scheduleSaveService)
    {
        return DB::transaction(function () use ($scheduleSaveService, $request) {
            $scheduleSaveService
                ->setCenter($this->center)
                ->setRequest($request)
                ->save()
                ->saveTimes();

            return new SuccessResponse();
        });
    }


    public function show()
    {
        $data = [
            'record' => $this->record,
            'details' => $this->record->details()->orderBy('started_at')->get(),
        ];

        return view('centers.schedules.admin.show', $data);
    }

    public function edit()
    {
        list($started_time_hr, $started_time_mn, ) = explode(':', $this->record->started_time);
        list($finished_time_hr, $finished_time_mn, ) = explode(':', $this->record->finished_time);


        list($reserve_duration_hr, $reserve_duration_mn) = [
            floor(($this->record->reserve_duration/15) / 4),
            floor((($this->record->reserve_duration/15) % 4) * 15),
        ];
        list($gap_duration_hr, $gap_duration_mn) = [
            floor(($this->record->gap_duration/15) / 4),
            floor((($this->record->gap_duration/15) % 4) * 15),
        ];

        $details = $this->record->details()->orderBy('started_at')->get();

        $detailsDisable = $this->record->details()->onlyTrashed()->orderBy('started_at')->get();

        $data = [
            'record' => $this->record,
            'details' => $details,
            'details_disable' => $detailsDisable,
            'room_types' => RoomType::getValues(),
            'hours' => Arr::getDailyHours(),
            'minutes' => Arr::getDailyMinutes(),
            'started_time_hr' => $started_time_hr,
            'started_time_mn' => $started_time_mn,
            'finished_time_hr' => $finished_time_hr,
            'finished_time_mn' => $finished_time_mn,
            'reserve_duration_hr' => $reserve_duration_hr,
            'reserve_duration_mn' => $reserve_duration_mn,
            'gap_duration_hr' => $gap_duration_hr,
            'gap_duration_mn' => $gap_duration_mn,
            'form' => [
                'action' => route('admin.center.schedule.update', [$this->center->id, $this->record->id]),
                'method' => 'put',
            ]
        ];

        return view('centers.schedules.admin.form', $data);
    }

    public function update(ScheduleRequest $request, ScheduleSaveService $scheduleSaveService)
    {
        return DB::transaction(function () use ($scheduleSaveService, $request) {
            $scheduleSaveService
                ->setCenter($this->center)
                ->setRecord($this->record)
                ->setRequest($request)
                ->save()
                ->saveTimes(true);

            return new SuccessResponse();
        });
    }

    public function delete()
    {
        if($this->record->rooms()->count() == 0)
        {
            $this->record->forceDelete();
            return new SuccessResponse();
        }
        return new FailedResponse('status', 'به دلیل استفاده یک یا چند اتاق از این زمان‌بندی، امکان حذف وجود ندارد.');
        // $currentUser = $this->currentUser();

        // return DB::transaction(function () use ($id, $currentUser, $centerService) {

        //     ModelHasRoles::
        //         join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        //         ->join('users', 'model_has_roles.model_id', '=', 'users.id')
        //         ->where('roles.center_id', $this->center->id)
        //         ->where('users.id', $id)
        //         ->where('users.id', '!=', $currentUser->id)
        //         ->whereNotIn('roles.slug', ['admin', 'user'])
        //         ->delete();

        //     $centerService->appendAdmins($this->center, [$id]);

        //     $this->center->users()->detach([$id]);

        //     app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        //     return new SuccessResponse();
        // });
    }

    private function breadcrumb()
    {
        $action = Router::actionName();

        $breadcrumb = [
            [
                'title' => 'مراکز',
                'link' => route('admin.center.index'),
            ],
            [
                'title' => $this->center->name,
                'link' => route('admin.center.show', $this->center->id),
            ],
            [
                'title' => 'زمان‌بندی ها',
                'link' => route('admin.center.schedule.index', $this->center->id),
            ],
        ];

        if($action == 'create')
        {
            $breadcrumb[] =
                [
                    'title' => 'تعریف زمان‌بندی جدید',
                    'link' => route('admin.center.schedule.create', $this->center->id),
                ];
        }
        else if($action == 'show')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->name,
                    'link' => route('admin.center.schedule.show', [$this->center->id, $this->record->id]),
                ];
        }
        else if($action == 'edit')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->name,
                    'link' => route('admin.center.schedule.show', [$this->center->id, $this->record->id]),
                ];
            $breadcrumb[] =
                [
                    'title' => 'ویرایش',
                    'link' => route('admin.center.schedule.edit', [$this->center->id, $this->record->id]),
                ];
        }
        $this->setBreadcrumb($breadcrumb);
    }
}
