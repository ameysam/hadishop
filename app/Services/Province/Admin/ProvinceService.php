<?php

namespace App\Services\Province\Admin;

use App\Constants\CacheConstant;
use App\Models\Country;
use App\Models\Province;
use App\Models\ProvinceCity;
use App\Services\DateTime\DateTimeComponentsConvertService;
use Illuminate\Support\Facades\Cache;

class ProvinceService
{
    /**
     * @var int
     */
    private $ttl;


    /**
     * __construct
     * @return void
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function __construct()
    {
        /* Set time to live on the cache */
        $this->ttl = DateTimeComponentsConvertService::minToSecond(CacheConstant::CACHE_SINGLE_MIN); # 10 minutes
    }

    /**
     * Get all provinces
     *
     * @return mixed
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function getProvinces()
    {
        $key_name = CacheConstant::PROVINCE_LIST;

        return Cache::remember($key_name, $this->ttl, function(){

            /* Fetch records */
            $provinces = Province::get();

            return $provinces;
        });
    }

    /**
     * Get Province record
     * Fetch a province record by id from cache or database.
     *
     * @param int $id
     * @return Province
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function getProvince(int $id)
    {
        /* Name of the key */
        $key_name = CacheConstant::PROVINCE_SINGLE . $id;

        return Cache::remember($key_name, $this->ttl, function() use ($id){

            /* Fetch the record */
            $province = Province::findOrFail($id);

            return $province;
        });
    }


    /**
     * Get City record
     * Fetch a city record by id from cache or database.
     *
     * @param int $id
     * @return ProvinceCity
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function getCity(int $id)
    {
        /* Name of the key */
        $key_name = CacheConstant::CITY_SINGLE . $id;

        return Cache::remember($key_name, $this->ttl, function() use ($id){

            /* Fetch the record */
            $record = ProvinceCity::findOrFail($id);

            return $record;
        });
    }

    /**
     * @param mixed $province
     * @return mixed
     */
    public function getCities($province)
    {
        $province_id = $province;
        if($province instanceof Province)
        {
            $province_id = $province->id;
        }

        /* Name of the key */
        $key_name = CacheConstant::CITY_LIST . $province_id;

        return Cache::remember($key_name, $this->ttl, function() use ($province_id){

            /* Fetch the record */
            return ProvinceCity::where('province_id', $province_id)->get(['id', 'title']);
        });
    }
}
