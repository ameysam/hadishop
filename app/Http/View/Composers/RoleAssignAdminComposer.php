<?php

namespace App\Http\View\Composers;

use App\Models\Center;
use App\Services\Center\Self\CSSService;
use Illuminate\View\View;

class RoleAssignAdminComposer
{

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
        $centers = Center::orderByName()->get();
        $center_roles_url_prefix = route('admin.center.index');

        $view->with('_centers', $centers);
        $view->with('_center_roles_url_prefix', $center_roles_url_prefix);
    }
}
