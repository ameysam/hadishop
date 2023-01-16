<?php

namespace App\Http\View\Composers;

use App\Models\Center;
use Illuminate\View\View;

class GlobalCenterRecordComposer
{
     /**
     * @var Center
     */
    private $center;


    /**
     * LayoutAdminComposer constructor.
     * @param Center $center
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function __construct(Center $center = null)
    {
        $this->center = $center;
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
        $view->with('g_center', $this->center);
    }
}
