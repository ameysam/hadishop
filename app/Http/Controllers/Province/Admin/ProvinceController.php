<?php

namespace App\Http\Controllers\Province\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use App\Models\Province;
use App\Repositories\Contracts\ProvinceRepositoryInterface;
use App\Services\Province\Admin\ProvinceService;


/**
 * Class ProvinceController
 * @package App\Http\Controllers\Province\Admin
 * @property provinceService $provinceService
 * @property ProvinceRepositoryInterface $provinceRepository
 * @property Province $province
 */
class ProvinceController extends Controller
{

    /**
     * @var provinceService
     */
    private $provinceService;


    /**
     * ProvinceController constructor.
     * @param ProvinceService $provinceService
     */
    public function __construct(ProvinceService $provinceService)
    {
        $this->provinceService = $provinceService;
    }


    /**
     * @return mixed
     */
    public function index()
    {
        return [];
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function provinces(int $id)
    {
        $provinces = $this->provinceService->getProvinces($id);
        $data = [
            'provinces' => $provinces,
        ];

        return new SuccessResponse('status', null, $data);
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function cities(int $id)
    {
        $cities = $this->provinceService->getCities($id);
        $data = [
            'cities' => $cities,
        ];

        return new SuccessResponse('status', null, $data);
    }
}
