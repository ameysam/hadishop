<?php

namespace App\Http\Controllers\Meeting\Admin;

use App\Constants\Types\File\FileReasonType;
use App\Constants\Types\File\FileVisibilityType;
use App\Constants\Types\Meeting\MeetingStatusType;
use App\Constants\Types\MeetingUser\MeetingUserStatusPredictedType;
use App\Events\Meeting\RegisterMeetingEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Meeting\MeetingPredictRequest;
use App\Http\Requests\Meeting\MeetingProceedingsRequest;
use App\Http\Requests\Meeting\MeetingStatusRequest;
use App\Http\Responses\SuccessResponse;
use App\Models\Meeting;
use App\Models\MeetingUser;
use App\Models\User;
use App\Services\Comment\CommentSaveService;
use App\Services\File\Src\FileSaveService;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;

class MeetingController extends Controller
{

    /**
     * @var int
     */
    private $id;

    public function __construct()
    {
        $this->id = Router::getParam('id');
        // $methodName = Router::actionName();
        // if(in_array($methodName, ['show']))
        // {
        //     $this->record = Meeting::whereActive()->whereNotExpired()->findOrFail($this->id);
        // }

        if(request()->query('user'))
        {
            $this->middleware(["permission:meeting-list-search"])->only('index');
        }
        else
        {
            $this->middleware(["permission:meeting-list"])->only('index');
        }
        // $this->middleware(["permission:meeting-edit"])->only('predictUpdate');
        $this->middleware(["permission:meeting-show"])->only('show', 'predictUpdate');
    }


    public function index(Request $request)
    {
        $currentUser = $this->currentUser();
        $meetings = Meeting::with([
                        'center',
                        'room:id,name',
                        'users' => function($query) use ($currentUser){
                            $query->where('users.id', $currentUser->id);
                        }
                        ]);

        if(! $currentUser->isSuperAdmin())
        {
            $meetings
                // ->whereActive()
                ->whereUsersContains($currentUser->id)
                ->whereHas('center', function($query){
                    $query->whereActive();
                });
        }

        $searchParams = $request->query();
        $user = null;
        if(count($searchParams))
        {
            if(isset($searchParams['user']))
            {
                $user_id = $searchParams['user'];
                $meetings->whereUsersContains($user_id);
                $user = User::findOrFail($user_id);
            }
        }

        $meetings = $meetings
                        ->orderBy('holding_status')
                        ->orderBy('started_at')
                        ->paginate(9)
                        ->withQueryString();


        $data = [
            'records' => $meetings,
            'user' => $user,
            'predict_statuses' => MeetingUserStatusPredictedType::getValues('keys'),
        ];

        $this->breadcrumb();

        return view('reserves.admin.index', $data);
    }


    public function show()
    {
        $currentUser = $this->currentUser();

        $record = Meeting::query();

        if(! $currentUser->isSuperAdmin())
        {
            $record->whereHas('users', function($query) use ($currentUser){
                $query->where('users.id', $currentUser->id);
            });
        }

        return
        $record = $record->with('center:id,name,address','room:id,name', 'users:id,first_name,last_name')->whereActive()->findOrFail($this->id);

        $record->day_fa = jdate($record->day)->format('%A Y/m/d');
        $record->started_time = jdate($record->started_time)->format('H:i');
        $record->finished_time = jdate($record->finished_time)->format('H:i');
        $record->holding_status_fa = $record->holding_status_fa;
        $record->description = nl2br($record->description);

        $data = [
            'record' => $record
        ];

        return new SuccessResponse('status', null, $data);
    }


    public function view()
    {
        $currentUser = $this->currentUser();

        $record = Meeting::query();

        if(! $currentUser->isSuperAdmin())
        {
            $record
                ->where(function($query) use ($currentUser){
                    $query
                        ->whereHas('users', function($query) use ($currentUser){
                            $query->where('users.id', $currentUser->id);
                        })
                        ->orWhereHas('roles.users', function($query) use ($currentUser){
                            $query->where('users.id', $currentUser->id);
                        });
                })
                ->whereHas('center', function($query){
                    $query->whereActive();
                });
        }

        // return
        $record = $record->with([
                'center:id,name,address,status',
                'room:id,name',
                'users:id,first_name,last_name',
                'comments' => function($query){
                    $query->with('user:id,first_name,last_name', 'files');
                },
                'roles' => function($query){
                    $query->with('users:id,first_name,last_name');
                },
            ])
            // ->whereActive()
            ->findOrFail($this->id);

        $record->main_user = $record->getCurrentUserPivotRecord($currentUser);

        $this->record = $record;

        $data = [
            'record' => $record,
            'predict_statuses' => MeetingUserStatusPredictedType::getValues('keys'),
        ];

        $this->breadcrumb();

        return view('reserves.admin.show', $data);
    }


    public function predictUpdate(MeetingPredictRequest $request)
    {
        $currentUser = $this->currentUser();

        $record = MeetingUser::where([
                'meeting_id' => $this->id,
                'user_id' => $currentUser->id,
            ])
            ->whereHas('meeting', function($query){
                $query
                    ->whereHas('center', function($query){
                        $query->whereActive();
                    })
                    ->where('id', $this->id)->whereActiveOrCanceled()->whereNotExpired();
            });

        if(! $currentUser->isSuperAdmin())
        {
            $record->where('user_id', $currentUser->id);
            // $record->whereHas('user', function($query) use ($currentUser){
            // });
        }

        if($record->count() < 1)
        {
            // abort(404);
            $meeting = Meeting::
                    whereHas('roles.users', function($query) use ($currentUser){
                        $query->where('users.id', $currentUser->id);
                    })
                    ->whereHas('center', function($query){
                        $query->whereActive();
                    })
                    ->whereActive()
                    ->whereNotExpired()
                    ->findOrFail($this->id);

            $meeting->users()->syncWithoutDetaching([
                $currentUser->id => ['status_predicted' => $request['status']]
            ]);
        }
        else
        {
            $record->update(['status_predicted' => $request['status']]);
        }

        return new SuccessResponse();
    }


    public function preceedingsView()
    {
        $currentUser = $this->currentUser();

        $record = Meeting::query();

        if(! $currentUser->isSuperAdmin())
        {
            $record->whereAdminOrSecretary($currentUser->id);
            // $record->where(function($query) use ($currentUser){
            //     $query
            //         ->whereHas('center', function($query) use ($currentUser){
            //             $query
            //                 ->whereActive()
            //                 ->where('admins_quick', 'like', '%"' . $currentUser->id . '"%');
            //         })
            //         ->where('secretary_id', $currentUser->id);
            // });
        }

        $record = $record->whereActiveOrCanceled()->findOrFail($this->id);

        $data = [
            'record' => $record
        ];

        return new SuccessResponse('status', null, $data);
    }


    public function preceedingsUpdate(MeetingProceedingsRequest $request)
    {
        $currentUser = $this->currentUser();

        $record = Meeting::query();

        if(! $currentUser->isSuperAdmin())
        {
            $record->whereAdminOrSecretary($currentUser->id);
            // $record->where(function($query) use ($currentUser){
            //     $query
            //         ->whereHas('center', function($query) use ($currentUser){
            //             $query
            //                 ->whereActive()
            //                 ->where('admins_quick', 'like', '%"' . $currentUser->id . '"%');
            //         })
            //         ->where('secretary_id', $currentUser->id);
            // });
        }

        $record = $record->whereActiveOrCanceled()->findOrFail($this->id);

        $record->update([
            'proceedings' => $request['proceedings'],
        ]);

        return new SuccessResponse();
    }


    public function statusCancellation()
    {
        $currentUser = $this->currentUser();

        $record = $this->getRecord($currentUser)->with('center')->findOrFail($this->id);

        if(! $currentUser->isSuperAdmin() && !$currentUser->hasRole(['admin', $record->center->adminRoleName()]))
        {
            abort(403);
        }

        // return DB::transaction(function () {
            if($record->isActive())
            {
                $status = MeetingStatusType::MEETING_STATUS_CANCELED;
                $eventStatus = 'canceled';
            }
            else
            {
                $eventStatus = 'activated';
                $status = MeetingStatusType::MEETING_STATUS_ACTIVE;
            }
            $record->status = $status;
            $record->save();

            RegisterMeetingEvent::dispatch($record, $eventStatus);

            return new SuccessResponse('status', null, ['new_status' => $record->status]);
        // });
    }

    // public function statusUpdate(MeetingStatusRequest $request)
    // {
    //     $currentUser = $this->currentUser();

    //     $record = $this->getRecord($currentUser)->findOrFail($this->id);

    //     // return DB::transaction(function () {
    //         $old_status = $request['old_status'];

    //         if($old_status == MeetingStatusType::MEETING_STATUS_ACTIVE)
    //         {
    //             $status = MeetingStatusType::MEETING_STATUS_INACTIVE;
    //         }
    //         else
    //         {
    //             $status = MeetingStatusType::MEETING_STATUS_ACTIVE;
    //         }
    //         $record->status = $status;
    //         $record->save();

    //         return new SuccessResponse('status', null, ['new_status' => $record->status]);
    //     // });
    // }


    private function getRecord(User $currentUser)
    {
        $record = Meeting::query();

        if(! $currentUser->isSuperAdmin())
        {
            $record
                ->where(function($query) use ($currentUser){
                    $query
                        ->whereHas('users', function($query) use ($currentUser){
                            $query->where('users.id', $currentUser->id);
                        })
                        ->orWhereHas('roles.users', function($query) use ($currentUser){
                            $query->where('users.id', $currentUser->id);
                        });
                })
                ->whereHas('center', function($query){
                    $query->whereActive();
                });
        }

        return $record
            // ->whereActive()
            ->whereNotExpired();
    }


    /**
     * Set breadcrumb.
     */
    private function breadcrumb()
    {
        $action = Router::actionName();

        $breadcrumb = [
            [
                'title' => 'جلسات',
                'link' => route('admin.meeting.index'),
            ],
        ];

        if($action == 'view')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->name,
                    'link' => route('admin.meeting.show', $this->record->id),
                ];
        }
        $this->setBreadcrumb($breadcrumb);
    }
}
