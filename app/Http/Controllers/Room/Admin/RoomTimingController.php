<?php

namespace App\Http\Controllers\Room\Admin;

use App\Constants\Types\Meeting\MeetingPeriodicType;
use App\Constants\Types\Room\RoomType;
use App\Events\Meeting\RegisterMeetingEvent;
use App\Exceptions\MeetingPeriodicConflictException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomRequest;
use App\Http\Requests\Room\RoomScheduleDeleteRequest;
use App\Http\Requests\Room\RoomScheduleRequest;
use App\Http\Requests\Room\RoomTimingRequest;
use App\Http\Responses\FailedResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Center;
use App\Models\Meeting;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use App\Models\User;
use App\Services\Meeting\MeetingSaveService;
use App\Services\Room\Admin\RoomSaveService;
use App\Services\Room\Admin\RoomScheduleSaveService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;

class RoomTimingController extends Controller
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var Room
     */
    private $record;

    /**
     * @var int
     */
    private $meeting_id;

    /**
     * @var Meeting
     */
    private $meeting;

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
        if($center->isInactive())
        {
            abort(404);
        }
        $this->center = $center;

        if($this->id = Router::getParam('id1'))
        {
            $this->record = Room::whereCenter($this->center)
                                    ->with([
                                            'schedule' => function($query){
                                                $query->with('details');
                                            },
                                            'meetings' => function($query){
                                                $query->whereActive();
                                            }
                                        ])
                                    ->whereHas('schedule')//, function($q){
                                        // $q->whereHas('details', function($q){
                                        //     $q->where('finished_at', '>', Carbon::now());
                                        // });
                                    // })
                                    ->findOrFail($this->id);
        }

        if($this->meeting_id = Router::getParam('id2'))
        {
            $this->meeting = Meeting::with('users:id,first_name,last_name,id_no', 'secretary:id,first_name,last_name,id_no')->findOrFail($this->meeting_id);

            $permission_name = 'center-edit';
            if(Router::actionName('delete'))
            {
                $permission_name = 'center-delete';
            }
            $this->middleware(function ($request, $next) use ($permission_name) {
                $this->currentUser = $this->currentUser();

                if($this->currentUser->isSuperAdmin() || ($this->currentUser->id == $this->meeting->user_id) || $this->currentUser->hasp($permission_name, $this->meeting->center_id))
                {
                    return $next($request);
                }
                else
                {
                    abort(403);
                }
            });
        }

        // $this->middleware(["center-permission:room-show,{$this->center->id}"]);
        $this->middleware(["permission:room-show"]);
    }


    public function index()
    {
        $schedules = ScheduleDetail::where(['center_id' => $this->center->id, 'schedule_id' => $this->record->schedule_id])
                ->where('finished_at', '>', Carbon::now())
                ->orderBy('started_at', 'asc')
                ->paginate(7);


        $schedules_count = $schedules->count();
        $last_schedule = ($schedules[$schedules_count-1]);

        $additional_days = [];
        for($i = 1; $i <= (7 - $schedules_count); $i++)
        {
            $last_day = Carbon::parse($last_schedule->finished_at ?? now());
            $additional_days[] = $last_day->addDays($i);
        }

        foreach($schedules as $schedule)
        {
            $schedule->values = [];
        }

        $data = [
            'room' => $this->record,
            'schedules' => $schedules,
            // 'min_started_time' => $minStartedTime,
            // 'max_finished_time' => $maxFinishedTime,
            'min_started_time' => $this->record->schedule->started_time,
            'max_finished_time' => $this->record->schedule->finished_time,
            'additional_days' => $additional_days,
            'periodic_types' => MeetingPeriodicType::getValues(),
            'form' => [
                'action' => route('admin.center.room.timing.store', [$this->center->id, $this->record->id]),
                'method' => 'post',
            ]
        ];

        $this->breadcrumb();

        return view('centers.rooms.timings.admin.calendar', $data);
    }

    public function store(RoomTimingRequest $request, MeetingSaveService $meetingSaveService)
    {
        $currentUser = $this->currentUser();

        $secretary = $request['secretary_id'] ? User::findOrFail($request['secretary_id']) : null;

        try
        {
            return DB::transaction(function () use ($request, $currentUser, $secretary, $meetingSaveService) {
                $meeting = $meetingSaveService
                    ->setUser($currentUser)
                    ->setCenter($this->center)
                    ->setRoom($this->record)
                    ->setSecretary($secretary)
                    ->setRequest($request)
                    ->run();

                RegisterMeetingEvent::dispatch($meeting, 'store');

                return new SuccessResponse();
            });
        }
        catch(Exception $e)
        {
            return new FailedResponse('status', $e->getMessage(), ['type' => 'confirm']);
        }
    }

    public function edit()
    {
        $currentUser = $this->currentUser();
        if(! $currentUser->isSuperAdmin() && $this->meeting->isExpired())
        {
            abort(404);
        }

        $schedules = ScheduleDetail::where(['center_id' => $this->center->id, 'schedule_id' => $this->record->schedule_id])
                ->where('finished_at', '>', Carbon::now())
                ->orderBy('started_at', 'asc')
                ->paginate(7);


        $schedules_count = $schedules->count();
        $last_schedule = ($schedules[$schedules_count-1]);

        $additional_days = [];
        for($i = 1; $i <= (7 - $schedules_count); $i++)
        {
            $last_day = Carbon::parse($last_schedule->finished_at ?? now());
            $additional_days[] = $last_day->addDays($i);
        }

        foreach($schedules as $schedule)
        {
            $schedule->values = [];
        }

        $data = [
            'room' => $this->record,
            'record' => $this->meeting,
            'schedules' => $schedules,
            'min_started_time' => $this->record->schedule->started_time,
            'max_finished_time' => $this->record->schedule->finished_time,
            'additional_days' => $additional_days,
            'periodic_types' => MeetingPeriodicType::getValues(),
            'form' => [
                'action' => route('admin.center.room.timing.update', [$this->center->id, $this->record->id, $this->meeting->id]),
                'method' => 'put',
            ]
        ];

        $this->breadcrumb();

        return view('centers.rooms.timings.admin.calendar-edit', $data);
    }

    public function update(RoomTimingRequest $request, MeetingSaveService $meetingSaveService)
    {
        $currentUser = $this->currentUser();

        $secretary = $request['secretary_id'] ? User::findOrFail($request['secretary_id']) : null;
        try
        {
            return DB::transaction(function () use ($request, $currentUser, $secretary, $meetingSaveService) {
                $meeting = $meetingSaveService
                    ->setUser($currentUser)
                    ->setCenter($this->center)
                    ->setRoom($this->record)
                    ->setSecretary($secretary)
                    ->setRequest($request)
                    ->setRecord($this->meeting)
                    ->run();

                RegisterMeetingEvent::dispatch($meeting, 'update');

                return new SuccessResponse();
            });
        }
        catch(Exception $e)
        {
            return new FailedResponse('status', $e->getMessage(), ['type' => 'confirm']);
        }
    }


    public function delete()
    {
        $currentUser = $this->currentUser();

        if(!$currentUser->isSuperAdmin() && !$this->meeting->isNotStartedYet())
        {
            abort(404);
        }
        $this->meeting->forceDelete();

        return new SuccessResponse();
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
                'link' => route('admin.center.edit', $this->center->id),
            ],
            [
                'title' => 'اتاق‌ها',
                'link' => route('admin.center.show', $this->center->id),
                // 'link' => route('admin.center.room.index', $this->center->id),
            ],
            [
                'title' => $this->record->name,
                'link' => route('admin.center.room.edit', [$this->center->id, $this->record->id]),
            ],
        ];

        if($action == 'index')
        {
            $breadcrumb[] =
                [
                    'title' => 'رزرو',
                    'link' => route('admin.center.room.timing.index', [$this->center->id, $this->record->id]),
                ];
        }
        else if($action == 'edit')
        {
            $breadcrumb[] =
                [
                    'title' => "ویرایش «{$this->meeting->name}»",
                    'link' => route('admin.center.room.timing.edit', [$this->center->id, $this->record->id, $this->meeting->id]),
                ];
        }

        $this->setBreadcrumb($breadcrumb);
    }
}
