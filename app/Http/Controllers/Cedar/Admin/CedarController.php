<?php

namespace App\Http\Controllers\Cedar\Admin;

use App\Services\CURL\Curl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CedarController extends Controller
{
    public function locality(Request $request)
    {
        $curl = new Curl($request['url']);
        $curl->init('get');
        $result = $curl->exec();
        return json_decode($result, true);
    }


    public function direction(Request $request)
    {
        $curl = new Curl($request['url']);
        $curl->init('get');
        $result = $curl->exec();
        return json_decode($result, true);
    }
}
