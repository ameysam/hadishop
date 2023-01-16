<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Center;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    public function index()
    {
        $currentUser = $this->currentUser();

        $centers = Center::whereActive();

        if(! $currentUser->isSuperAdmin())
        {
            $centers->whereHas('users', function($query) use ($currentUser){
                $query->where('users.id', $currentUser->id);
            });
        }
        $centers = $centers->with('type')->withCount('rooms')->get();

        $data = [
            'records' => $centers
        ];


        return view('home.admin', $data);
        // return view('home.calendar');
    }
}
