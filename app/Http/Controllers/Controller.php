<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * Share an array value for set in breadcrumb in view files.
     *
     * @param array $value
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function setBreadcrumb(array $value)
    {
        view()->share('_page_breadcrumb', $value);
    }


    public function currentUser()
    {
        return Auth::user();
    }
}
