<?php

namespace App\Http\Controllers\Room\Admin;

use App\Constants\Types\Room\RoomType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomRequest;
use App\Http\Responses\SuccessResponse;
use App\Models\Center;
use App\Models\Room;
use App\Models\Schedule;
use App\Services\Room\Admin\RoomSaveService;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

class RoomController extends Controller
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

        $this->id = Router::getParam('id1');

        if($this->id)
        {
            $this->record = Room::findOrFail($this->id);
        }
        if($ids = Router::getParam('ids'))
        {
            $this->ids = explode(',', $ids);
        }

        $this->middleware(["center-permission:room-list,{$this->center->id}"])->only('index');
        $this->middleware(["center-permission:room-add,{$this->center->id}"])->only('create', 'store');
        $this->middleware(["center-permission:room-edit,{$this->center->id}"])->only('edit', 'update');
        $this->middleware(["center-permission:room-show,{$this->center->id}"])->only('show');

        $this->breadcrumb();
    }


    public function index()
    {
        return redirect()->route('admin.center.show', $this->center->id);

        $records = Room::whereCenter($this->center)->with('schedule')->latest()->get();

        $data = [
            'records' => $records,
        ];

        return view('centers.rooms.admin.index', $data);
    }


    public function create()
    {
        $schedules = Schedule::whereCenter($this->center)->latest()->get();
        $data = [
            'schedules' => $schedules,
            'room_types' => RoomType::getValues(),
            'form' => [
                'action' => route('admin.center.room.store', $this->center->id)
            ]
        ];

        return view('centers.rooms.admin.form', $data);
    }


    public function store(RoomRequest $request, RoomSaveService $roomSaveService)
    {
        $roomSaveService
            ->setCenter($this->center)
            ->save($request);

        return new SuccessResponse();
    }


    public function show()
    {
        $data = [
            'record' => $this->record,
        ];

        return view('centers.rooms.admin.show', $data);
    }

    public function edit()
    {
        $schedules = Schedule::whereCenter($this->center)->latest()->get();

        $data = [
            'schedules' => $schedules,
            'record' => $this->record,
            'room_types' => RoomType::getValues(),
            'form' => [
                'action' => route('admin.center.room.update', [$this->center->id, $this->record->id]),
                'method' => 'put',
            ]
        ];

        return view('centers.rooms.admin.form', $data);
    }

    public function update(RoomRequest $request, RoomSaveService $roomSaveService)
    {
        $roomSaveService
            ->setCenter($this->center)
            ->setRecord($this->record)
            ->save($request);

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
                'link' => route('admin.center.show', $this->center->id),
            ],
            [
                'title' => 'اتاق‌ها',
                'link' => route('admin.center.show', $this->center->id),
            ],
        ];

        if($action == 'create')
        {
            $breadcrumb[] =
                [
                    'title' => 'تعریف اتاق جدید',
                    'link' => route('admin.center.room.create', $this->center->id),
                ];
        }
        else if($action == 'show')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->name,
                    'link' => route('admin.center.room.show', [$this->center->id, $this->record->id]),
                ];
        }
        else if($action == 'edit')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->name,
                    'link' => route('admin.center.room.show', [$this->center->id, $this->record->id]),
                ];
            $breadcrumb[] =
                [
                    'title' => 'ویرایش',
                    'link' => route('admin.center.room.edit', [$this->center->id, $this->record->id]),
                ];
        }
        $this->setBreadcrumb($breadcrumb);
    }
}
