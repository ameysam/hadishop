<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfilePasswordRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\User\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPasswordController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        $data = [
            'record' => $user,
            'form' => [
                'method' => 'put',
                'action' => route('admin.profile.password.update'),
            ],
        ];

        $this->breadcrumb();

        return view('users.profile.password.edit', $data);
    }


    public function update(ProfilePasswordRequest $request, RegisterService $registerService)
    {
        $user = Auth::user();

        $registerService->setNewPassword($user, $request['password']);

        return new SuccessResponse('status', 'رمز عبور جدید با موفقیت بازنشانی شد.');
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
                'title' => 'ویرایش رمز عبور',
                'link' => route('admin.profile.password.edit'),
            ],
        ];

        $this->setBreadcrumb($breadcrumb);
    }
}
