<?php

namespace App\Http\Controllers\Room\Admin;

use App\Constants\Types\Room\RoomType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomRequest;
use App\Http\Requests\Room\RoomScheduleDeleteRequest;
use App\Http\Requests\Room\RoomScheduleRequest;
use App\Http\Responses\SuccessResponse;
use App\Models\Center;
use App\Models\Room;
use App\Models\Schedule;
use App\Services\Room\Admin\RoomSaveService;
use App\Services\Room\Admin\RoomScheduleSaveService;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

class RoomScheduleController extends Controller
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

        $this->middleware(["center-permission:room-edit,{$this->center->id}"]);
    }


    public function index()
    {
        $rooms = Room::whereCenter($this->center)->with('schedule')->latest()->get();

        $schedules = Schedule::whereCenter($this->center)->latest()->get();

        $roomsWithSchedule = collect([]);//$rooms->map(function($room){ return $room->schedule != null; });

        $roomsWithoutSchedule = collect([]);//$rooms->map(function($room){ return $room->schedule == null; });

        $this->breadcrumb();

        foreach($rooms as $room)
        {
            if($room->schedule)
            {
                $roomsWithSchedule->push($room);
            }
            else
            {
                $roomsWithoutSchedule->push($room);
            }
        }

        $data = [
            'rooms' => $rooms,
            'roomsWithSchedule' => $roomsWithSchedule,
            'roomsWithoutSchedule' => $roomsWithoutSchedule,
            'schedules' => $schedules,
            'form' => [
                'action' => route('admin.center.room.schedule.store', [$this->center->id]),
                'method' => 'post',
            ]
        ];

        return view('centers.rooms.admin.schedules', $data);
    }

    public function store(RoomScheduleRequest $request, RoomScheduleSaveService $roomSaveService)
    {
        $room = Room::whereCenter($this->center)->find($request['room_id']);

        $roomSaveService
            ->setRoom($room)
            ->save($request['schedule_id']);

        return new SuccessResponse();
    }

    public function delete(RoomScheduleDeleteRequest $request, RoomScheduleSaveService $roomSaveService)
    {
        $room = Room::whereCenter($this->center)->find($request['room_id']);

        $roomSaveService
            ->setRoom($room)
            ->save(null);

        return new SuccessResponse();
    }


    private function breadcrumb()
    {
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
                'title' => 'زمان‌بندی اتاق‌ها',
                'link' => route('admin.center.room.schedule.index', $this->center->id),
            ],
        ];

        $this->setBreadcrumb($breadcrumb);
    }
}
