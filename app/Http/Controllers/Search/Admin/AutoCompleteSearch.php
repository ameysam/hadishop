<?php

namespace App\Http\Controllers\Search\Admin;

use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\CustomRole;
use App\Models\Drug;
use App\Models\DrugTakingInstruction;
use App\Models\DrugType;
use App\Models\Room;
use App\Models\User;
use App\Services\User\Admin\UserService;
use Illuminate\Http\Request;

class AutoCompleteSearch extends Controller
{


    // private $center;

    // public function __construct(Center $center)
    // {
    //     $this->center = $center;
    // }

    public function users(Request $request, UserService $userService)
    {
        $keywords = $request->input('q', '.');

        $users = $userService->searchUsersByName($keywords, ['id', 'first_name', 'last_name', 'id_no', 'gender'], 20);

        $users->map(function($item){
            $item->name = ("{$item->full_name} ({$item->id_no})");
        });

        return $users;
    }

    public function centersRooms(Request $request)
    {
        $keywords = $request->input('q', '.');

        $centers = Center::where(function($query) use ($keywords){
            $query
                ->where('name', 'like', "%{$keywords}%")
                ->orWhereHas('rooms', function($query) use ($keywords){
                    $query->where('name', 'like', "%{$keywords}%");
                });
        })
        ->with('rooms:id,center_id,name')->get(['id', 'name']);

        $records = collect([]);

        $centers->map(function($item) use (&$records){
            foreach($item->rooms as $room)
            {
                $records->push([
                    'id' => $room->id,
                    'name' => "اتاق «{$room->name}» در «{$item->name}»",
                ]);
            }
        });

        return $records;
    }

    // public function roles(Request $request)
    // {
    //     // dd($this->center);
    //     $keywords = $request->input('q', '.');

    //     $records = CustomRole::
    //         where('title', 'like', "%{$keywords}%")->
    //         orWhere('slug', 'like', "%{$keywords}%")->
    //         take(20)->
    //         get(['id', 'title']);

    //     $records->map(function($item){
    //         $item->name = $item->title;
    //     });

    //     return $records;
    // }
}
