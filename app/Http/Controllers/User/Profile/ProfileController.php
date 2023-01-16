<?php

namespace App\Http\Controllers\User\Profile;

use App\Constants\Types\Auth\RegisterStatusType;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangeMobileCheckRequest;
use App\Http\Requests\User\ChangeMobileVerifyRequest;
use App\Http\Requests\User\ProfileInfoRequest;
use App\Http\Requests\User\ProfileUpdateRequest;
use App\Http\Responses\FailedResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Country;
use App\Services\Image\ImageService;
use App\Services\Province\Admin\ProvinceService;
use App\Services\SMS\Contracts\SMS;
use App\Services\User\RegisterService;
use App\Services\User\VerificationCodeAttemptService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    
    public function __construct()
    {

    }

    public function edit()
    {
        // dd('hfhgfhg');
        $user = Auth::user();

        $data = [
            'record' => $user,
            'form' => [
                'method' => 'put',
                'action' => route('admin.profile.update'),
            ],
        ];

        $this->breadcrumb();

        return view('users.profile.info.edit', $data);
    }


    public function update(ProfileUpdateRequest $request)
    {
        $user = Auth::user();

        $data = [
            'id_no' => $request['id_no'],
            'mobile_no' => $request['mobile_no'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'province_id' => $request['province_id'],
            'city_id' => $request['city_id'],
            'gender' => $request['gender'],
            'birthdate' => null,
        ];

        if($request['password'])
        {
            $data['password'] = $request['password'];
        }

        $user->update($data);

        return new SuccessResponse();
    }

    /**
     * Set breadcrumb.
     */
    private function breadcrumb()
    {
        $breadcrumb = [
            [
                'title' => 'پروفایل',
                'link' => '#',
            ],
            [
                'title' => 'ویرایش اطلاعات',
                'link' => route('admin.profile.edit'),
            ],
        ];

        $this->setBreadcrumb($breadcrumb);
    }
}
