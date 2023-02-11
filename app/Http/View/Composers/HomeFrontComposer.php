<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use App\Models\Month;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Services\User\Admin\UserModeService;

class HomeFrontComposer
{

    /**
     * LayoutAdminComposer constructor.
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function __construct()
    {
    }



    /**
     * Bind data to the view.
     *
     * @param View  $view
     * @return void
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function compose(View $view)
    {
        $categories = Category::latest('id')->get();
        $view->with('_main_categories', $categories);
    }
}
