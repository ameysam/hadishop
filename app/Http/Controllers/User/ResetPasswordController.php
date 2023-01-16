<?php

namespace App\Http\Controllers\User;

use App\Constants\Types\Auth\ResetPasswordStatusType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFindUserRequest;
use App\Http\Responses\FailedResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Country;
use App\Services\SMS\Contracts\SMS;
use App\Services\SMS\Contracts\SMSTemplate;
use App\Services\User\PasswordService;
use App\Services\User\RegisterService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{

    private $passwordService;

    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    /**
     * showIdNoForm
     *
     * @return view
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function showIdNoForm()
    {
        $data = [
            'countries' => Country::all(),
        ];

        return view('auth.password.password', $data);
    }

    /**
     * findUser
     *
     * @param RegisterFindUserRequest $request
     * @return mixed
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function findUser(RegisterFindUserRequest $request)
    {
        $full_id_no = "{$request['step1-code']}-{$request['id_no']}";

        #fetch the user by username value
        $user = $this->passwordService->findUser($full_id_no);

        if($user)
        {
            # set username value in a session
            session(['id_no' => $full_id_no]);
            session(['code' => $request['step1-code']]);

            $response_data = [
                'data' => [
                    'username' => $full_id_no,
                    'mobile' => Str::secureMobile($user->mobile_no),
                ],
            ];

            return new SuccessResponse('status', null, $response_data);
        }
        else
        {
            $response_data = [
                'data' => [
                    'username' => $full_id_no,
                ],
            ];

            return new FailedResponse('status', ResetPasswordStatusType::getValue(ResetPasswordStatusType::RESET_PASSWORD_STATUS_USER_NOT_FOUND), $response_data);
        }
    }


    /**
     * sendToken
     * @param Request $request
     * @param SMS $sms
     *
     * @return array
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function sendVerificationCode(Request $request, SMS $sms)
    {
        $id_no = session('id_no');

        #fetch the user by username value
        $user = $this->passwordService->findUser($id_no);

        if($user)
        {
            # Generate new verification code for the user.
            $this->passwordService->generateNewVerificationCode($user);

            # Send verification code by SMS
            $sms->setUser($user)->setToken($user->verification_code)->lookup();

            $response_data = [
                'data' => [
                    'username' => $user->id_no,
                ],
            ];

            return new SuccessResponse('status', null, $response_data);
        }
        else
        {
            return new FailedResponse('status', ResetPasswordStatusType::getValue(ResetPasswordStatusType::RESET_PASSWORD_STATUS_USER_NOT_FOUND));
        }
    }


    /**
     * sendToken
     * @param Request $request
     * @param SMS $sms
     *
     * @return array
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function verifyCode(Request $request, SMS $sms, RegisterService $registerService)
    {
        $request->validate([
            'code' => "required",
        ]);

        $id_no = session('id_no');

        #fetch the user by username value
        $user = $this->passwordService->findUser($id_no, ['*']);

        if($user)
        {
            return DB::transaction(function () use ($user, $request, $sms, $registerService) {

                # Verify the user by verification code
                $verify_result = $registerService->verify($user, $request['code']);

                if($verify_result)
                {
                    # Generate new password
                    $new_password = Str::randomPassword();

                    # Set generated password on the user record
                    $registerService->setNewPassword($user, $new_password);

                    # Send generated password to the user by SMS
                    $sms->setUser($user)
                        ->setTemplate(SMSTemplate::KAVENEGAR_PASSWORD)
                        ->setToken($new_password)
                        ->lookup();

                    // file_put_contents(storage_path('logs/sms_logs.txt'), $sms_result . PHP_EOL . PHP_EOL, FILE_APPEND);
                    // file_put_contents(storage_path('logs/sms_logs.txt'), $new_password . PHP_EOL . PHP_EOL, FILE_APPEND);

                    $response_data = [
                        'data' => [
                            'url' => route('login.index'),
                            // 'new_password' => $new_password,
                        ],
                    ];

                    return new SuccessResponse('status', __('layout.auth.password.response.success'), $response_data);
                }
                else
                {
                    return new FailedResponse('status', ResetPasswordStatusType::getValue(ResetPasswordStatusType::RESET_PASSWORD_STATUS_WRONG_TOKEN));
                }
            });
        }
        else
        {
            return new FailedResponse('status', ResetPasswordStatusType::getValue(ResetPasswordStatusType::RESET_PASSWORD_STATUS_USER_NOT_FOUND));
        }
    }
}
