<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileDoctorInfoRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\Doctor\Admin\DoctorInfoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorInfoController extends Controller
{

    private $doctorInfoService;

    public function __construct(DoctorInfoService $doctorInfoService)
    {
        $this->middleware(["permission:perscription-add|personnel-doctor"]);

        $this->doctorInfoService = $doctorInfoService;
    }

    public function edit()
    {
        $user = Auth::user();

        $data = [
            'user' => $user,
            'record' => $user->doctor,
            'form' => [
                'method' => 'put',
                'action' => route('admin.profile.doctor.update'),
            ],
        ];

        $this->breadcrumb();

        return view('users.profile.doctor.edit', $data);
    }


    public function update(ProfileDoctorInfoRequest $request)
    {
        $user = Auth::user();

        return DB::transaction(function () use ($user, $request) {
            $this->doctorInfoService->updateInfo($user, $request);

            return new SuccessResponse();
        });
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
                'title' => 'ویرایش اطلاعات پزشکی',
                'link' => route('admin.profile.doctor.edit'),
            ],
        ];

        $this->setBreadcrumb($breadcrumb);
    }
}
