<?php

namespace App\Http\Controllers\Event\Admin;

use App\Constants\Types\Event\EventPeriodicType;
use App\Constants\Types\File\FileReasonType;
use App\Constants\Types\File\FileVisibilityType;
use App\Events\Event\RegisterEventRecordEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventSaveRequest;
use App\Http\Responses\SuccessResponse;
use App\Models\Event;
use App\Models\Meeting;
use App\Models\Room;
use App\Models\User;
use App\Services\Comment\CommentSaveService;
use App\Services\Event\EventSaveService;
use App\Services\File\Src\FileSaveService;
use App\Services\Message\MessageFetchService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Morilog\Jalali\CalendarUtils;

class EventController extends Controller
{
     /**
     * @var int
     */
    private $id;

    public function __construct()
    {
        $this->id = Router::getParam('id');

        $this->middleware(["permission:event-list"])->only('index', 'items');
        $this->middleware(["permission:event-add"])->only('store');
        $this->middleware(["permission:event-edit"])->only('update');
        $this->middleware(["permission:event-show"])->only('show', 'view');
        $this->middleware(["permission:event-delete"])->only('delete');
    }


    public function index()
    {
        $data = [
            'route_store' => route('admin.event.store'),
            'route_show' => route('admin.event.items'),
            'periodic_types' => EventPeriodicType::getValues(),
        ];

        $this->breadcrumb();

        return view('events.admin.index', $data);
    }

    public function items(Request $request)
    {
        $type = $request['type'];

        $day = $request['day'];
        $day = explode('/', $day);

        $currentUser = $this->currentUser();

        $events = Event::whereUsersContains($currentUser->id);

        $meetings = Meeting::whereActive()
                    ->with([
                        'center',
                        'room:id,name',
                        'users' => function($query) use ($currentUser){
                            $query->where('users.id', $currentUser->id);
                        }
                        ])
                    ->whereUsersContains($currentUser->id)
                    ->whereHas('center', function($query){
                        $query->whereActive();
                    });

        if($type == 'month')
        {
            $first_day = $this->converDate($day[0], $day[1], 1);

            $last_day_number = 30;
            if($day[1] <= 6)
            {
                $last_day_number = 31;
            }
            else if($day[1] == 12)
            {
                $last_day_number = 29;
            }
            $last_day = $this->converDate($day[0], $day[1], $last_day_number);

            $events->where('day', '>=', $first_day)->where('day', '<=', $last_day);
            $meetings->where('day', '>=', $first_day)->where('day', '<=', $last_day);
        }
        else
        {
            $day = $this->converDate($day[0], $day[1], $day[2]);

            $events->whereDay($day);
            $meetings->whereDay($day);
        }


        $events = $events->orderBy('day')->orderBy('started_time')->get();
        $meetings = $meetings->orderBy('day')->orderBy('started_time')->get();

        $now = now();

        $events_data = [];
        foreach($events as $record)
        {
            $key = jdate($record->day)->format('d %B');
            $events_data[$key][] = [
                'id' => $record->id,
                'name' => $record->name,
                'start' => jdate($record->started_time)->format('H:i'),
                'finish' => $record->finished_time ? jdate($record->finished_time)->format('H:i') : null,
                'expired' => $record->finished_at ? ($record->finished_at < $now) : $record->started_at < $now,
            ];
        }
        $meetings_data = [];
        foreach($meetings as $record)
        {
            $key = jdate($record->day)->format('d %B');
            $meetings_data[$key][] = [
                'id' => $record->id,
                'name' => $record->name,
                'start' => jdate($record->started_time)->format('H:i'),
                'finish' => $record->finished_time ? jdate($record->finished_time)->format('H:i') : null,
                'expired' => $record->isExpired(),
            ];
        }

        $data = [
            'day' => $day,
            'events' => $events_data,
            'meetings' => $meetings_data,
        ];

        // dd($day);

        return new SuccessResponse('status', null, $data);

        // $day = Carbon::parse($day);
    }

    public function show($id)
    {
        $record = Event::with('users', 'guests', 'room', 'center')->findOrFail($id);

        $data_record = [
            'id' => $record->id,
            'name' => $record->name,
            'description' => $record->description,
            'day' => $record->day,
            'day_fa' => Str::numberFa(jdate($record->day)->format('Y/m/d')),
            'start' => jdate($record->started_time)->format('H:i'),
            'finish' => $record->finished_time ? jdate($record->finished_time)->format('H:i') : null,
            'room_center' => $record->room ? "<option value='{$record->room->id}' selected='selected'>اتاق «{$record->room->name}» در «{$record->center->name}»</option>" : null,
            'users' => [],
        ];

        foreach($record->users as $user)
        {
            $data_record['users'][] = "<option value='{$user->id}' selected='selected'>{$user->full_name} ({$user->id_no})</option>";
        }
        foreach($record->guests as $user)
        {
            $data_record['users'][] = "<option value='{$user->first_name} {$user->last_name}' selected='selected'>{$user->first_name} {$user->last_name}</option>";
        }

        $data = [
            'record' => $data_record,
        ];

        return new SuccessResponse('status', null, $data);
    }

    public function store(EventSaveRequest $request, EventSaveService $eventSaveService, MessageFetchService $messageFetchService)
    {
        $currentUser = $this->currentUser();

        return DB::transaction(function () use ($request, $currentUser, $eventSaveService, $messageFetchService) {

            $event = $eventSaveService
                    ->setUser($currentUser)
                    ->setRoomAndCenter($this->getRoom($request))
                    ->setRequest($request)
                    ->run();

            RegisterEventRecordEvent::dispatch($event, 'store');

            $_unseen_messages_count = $messageFetchService
                ->whereReceivers([$currentUser->id])
                ->whereUnseen()
                ->prepareQuery()
                ->count();

            return new SuccessResponse('status', null, ['unseen_messages_count' => $_unseen_messages_count]);
        });
    }

    public function update(EventSaveRequest $request, EventSaveService $eventSaveService, $id, MessageFetchService $messageFetchService)
    {
        $currentUser = $this->currentUser();

        $record = Event::whereUsersContains($currentUser->id)->findOrFail($id);

        return DB::transaction(function () use ($request, $currentUser, $eventSaveService, $record, $messageFetchService) {
            $event = $eventSaveService
                ->setUser($currentUser)
                ->setScenario('update')
                ->setRoomAndCenter($this->getRoom($request))
                ->setRequest($request)
                ->setRecord($record)
                ->run();

            RegisterEventRecordEvent::dispatch($event, 'update');

            $_unseen_messages_count = $messageFetchService
                ->whereReceivers([$currentUser->id])
                ->whereUnseen()
                ->prepareQuery()
                ->count();

            return new SuccessResponse('status', null, ['unseen_messages_count' => $_unseen_messages_count]);
        });
    }


    public function delete($id)
    {
        $currentUser = $this->currentUser();
        Event::where('id', $id)->whereUsersContains($currentUser->id)->delete();

        return new SuccessResponse();
    }

    public function view()
    {
        $currentUser = $this->currentUser();

        $record = Event::whereUsersContains($currentUser->id);

        // if(! $currentUser->isSuperAdmin())
        // {
        //     $record
        //         ->where(function($query) use ($currentUser){
        //             $query
        //                 ->whereHas('users', function($query) use ($currentUser){
        //                     $query->where('users.id', $currentUser->id);
        //                 })
        //                 ->orWhereHas('roles.users', function($query) use ($currentUser){
        //                     $query->where('users.id', $currentUser->id);
        //                 });
        //         })
        //         ->whereHas('center', function($query){
        //             $query->whereActive();
        //         });
        // }

        // return
        $record = $record->with([
                'center:id,name,address,status',
                'room:id,name',
                'users:id,first_name,last_name',
                // 'comments',
                'guests',
                // 'roles' => function($query){
                //     $query->with('users:id,first_name,last_name');
                // },
            ])
            // ->whereActive()
            ->findOrFail($this->id);

        // $record->main_user = $record->getCurrentUserPivotRecord($currentUser);

        $this->record = $record;

        $data = [
            'record' => $record,
        ];

        $this->breadcrumb();

        return view('events.admin.show', $data);
    }



    /**
     * Set breadcrumb.
     */
    private function breadcrumb()
    {
        $action = Router::actionName();

        $breadcrumb = [
            [
                'title' => 'رويدادها',
                'link' => route('admin.event.index'),
            ],
        ];

        if($action == 'view')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->name,
                    'link' => route('admin.event.show', $this->record->id),
                ];
        }
        $this->setBreadcrumb($breadcrumb);
    }


    private function converDate($year, $month, $day)
    {
        $date = CalendarUtils::toGregorian($year, $month, $day);
        if($date[1] < 10)
        {
            $date[1] = "0{$date[1]}";
        }
        if($date[2] < 10)
        {
            $date[2] = "0{$date[2]}";
        }

        return implode('-', $date);
    }


    private function getRoom(Request $request)
    {
        if($room_id = $request['room_id'])
        {
            return Room::findOrFail($room_id);
        }
        return null;
    }

}
