<?php

namespace App\Services\User\Admin;

use App\Models\Center;
use App\Models\User;
use App\Services\Contracts\Service;
use Illuminate\Http\Request;

class MemberService extends Service
{
    
    private $center;

    public function setCenter(Center $center)
    {
        $this->center = $center;
        return $this;
    }

    public function createRecord(Request $request)
    {
        $data = [
            'id_no' => $request['id_no'],
            'mobile_no' => $request['mobile_no'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'province_id' => $request['province_id'],
            'city_id' => $request['city_id'],
            'email' => $request['email'],
            'gender' => $request['gender'],
            'birthdate' => $birthdate ?? null,
            'password' => $request['password'],
            'center_creator_id' => $this->center->id,
        ];

        $user = User::create($data);

        return $user;
    }

    public function updateRecord(User $user, Request $request)
    {
        $data = [
            'id_no' => $request['id_no'],
            'mobile_no' => $request['mobile_no'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'province_id' => $request['province_id'] ?? null,
            'city_id' => $request['city_id'] ?? null,
            'gender' => $request['gender'],
            'birthdate' => $birthdate ?? null,
            'center_creator_id' => $this->center->id,
        ];

        if($request['password'])
        {
            $data['password'] = $request['password'];
        }

        $user->update($data);

        return $user;
    }
}
