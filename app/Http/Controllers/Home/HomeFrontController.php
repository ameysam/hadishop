<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Chart;
use Illuminate\Http\Request;

class HomeFrontController extends Controller
{
    public function index()
    {
        // return redirect()->route('admin.home.index');
        // $charts = Chart::with('user', 'post', 'center', 'children')->whereNull('parent_id')->get();
        // $data = [
        //     'charts' => $charts
        // ];
        return view('home.front');
    }
}
