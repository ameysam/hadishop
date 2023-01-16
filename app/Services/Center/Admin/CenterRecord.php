<?php

namespace App\Services\Center\Admin;

use App\Models\Center;
use Illuminate\Routing\Router;

class CenterRecord
{
    /**
     * @var Center
     */
    private $center;

    /**
     * __construct
     * @return void
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function __construct()
    {
        if($center_id = Router::getParam('cid'))
        {
            $this->center = Center::findOrFail($center_id);
        }
    }

    /**
     * @return Center
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function center()
    {
        return $this->center;
    }
}
