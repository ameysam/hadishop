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

        $data = [
            'records' => []
        ];

        return view('home.admin', $data);
        // return view('home.calendar');
    }
}
