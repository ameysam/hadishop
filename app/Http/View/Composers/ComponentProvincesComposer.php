<?php

namespace App\Http\View\Composers;

use App\Services\Province\Admin\ProvinceService;
use Illuminate\View\View;

class ComponentProvincesComposer
{
    private $provinceService;

    public function __construct(ProvinceService $provinceService)
    {
        $this->provinceService = $provinceService;
    }

    public function compose(View $view)
    {
        $provinces = $this->provinceService->getProvinces();

        $view->with('_provinces', $provinces);
    }
}