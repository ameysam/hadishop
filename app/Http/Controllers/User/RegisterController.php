<?php

namespace App\Http\Controllers\User;

use App\Constants\Types\Auth\RegisterStatusType;
use App\Constants\Types\CountryType\CountryCodeType;
use App\Constants\Types\User\UserGenderType;
use App\Constants\Types\User\UserNationalityType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFindUserRequest;
use App\Http\Requests\Auth\RegisterSetMobileRequest;
use App\Http\Requests\Auth\RegisterVerifyCodeRequest;
use App\Http\Requests\User\CompleteRegisterRequest;
use App\Http\Responses\FailedResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Country;
use App\Models\Month;
use App\Models\User;
use App\Rules\Mobile;
use App\Services\DateTime\DateTimeService;
use App\Services\Image\ImageService;
use App\Services\SMS\Contracts\SMS;
use App\Services\SMS\Contracts\SMSTemplate;
use App\Services\User\RegisterService;
use App\Services\User\VerificationCodeAttemptService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Morilog\Jalali\CalendarUtils;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    /**
     * @var RegisterService
     */
    private $registerService;


    /**
     * __construct
     * @param RegisterService $registerService
     * @return void
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
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
        return view('auth.register.register', $data);
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
        $user = $this->registerService->findUser($full_id_no);

        if($user)
        {
            $response_data = [
                'data' => [
                    'username' => $full_id_no,
                    'mobile' => Str::secureMobile($user->mobile_no),
                ],
            ];
            return new FailedResponse('status', RegisterStatusType::getValue(RegisterStatusType::REGISTER_STATUS_USERNAME_DUPLICATE), $response_data);
        }
        else
        {
            // # set username value in a session
            session(['id_no' => $full_id_no]);
            session(['code' => $request['step1-code']]);

            $response_data = [
                'data' => [
                    'username' => $full_id_no,
                    'selected_country' => $request['step1-code'],
                ],
            ];
            return new SuccessResponse('status', null, $response_data);
        }
    }


    /**
     * getMobile
     *
     * @param RegisterSetMobileRequest $request
     * @param SMS $sms
     *
     * @return array
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function getMobile(RegisterSetMobileRequest $request, SMS $sms, VerificationCodeAttemptService $verificationCodeAttemptService)
    {
        $id_no = session('id_no');
        $country_code = session('code');

        #fetch the user by username value
        $user = $this->registerService->findUser($id_no);

        if(! $user)
        {
            $country_mobile_no = Country::where('code', $request['step2-code'])->first();

            $country_user = Country::where('code', $country_code)->first();

            # Remove left zeros
            $mobile_no = ltrim($request['mobile_no'], '0');

            # Create user record
            $user = $this->registerService->registerUser($id_no, $mobile_no, $country_mobile_no, $country_user);

            if($verificationCodeAttemptService->hasPermission($user))
            {
                $generated_code = $this->registerService->resetVerificationCode($user);

                $verificationCodeAttemptService->setLog($user, 60); # 1 Hr

                # Send verification code by SMS
                $sms_result = $sms->setUser($user)->setToken($generated_code)->lookup();
            }

            session(['id' => $user->id]);
            session(['mobile_no' => $user->mobile_no]);

            $response_data = [
                'data' => [
                    'username' => $user->id_no,
                    'mobile' => $user->mobile_no,
                ],
            ];
            return new SuccessResponse('status', null, $response_data);
        }
        else
        {
            $response_data = [
                'data' => [
                    'username' => $user->id_no
                ],
            ];
            return new FailedResponse('status', RegisterStatusType::getValue(RegisterStatusType::REGISTER_STATUS_USER_NOT_FOUND), $response_data);
        }
    }


    /**
     * sendToken
     * @param RegisterVerifyCodeRequest $request
     * @param SMS $sms
     *
     * @return array
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function verifyCode(RegisterVerifyCodeRequest $request, SMS $sms)
    {
        $id = session('id');
        $id_no = session('id_no');
        $mobile_no = session('mobile_no');

        # Fetch the user by id & id_no & mobile_no
        $user = User::where([
            'id' => $id,
            'id_no' => $id_no,
            'mobile_no' => $mobile_no,
            ])->first();

        if($user)
        {
            return DB::transaction(function () use ($user, $request, $sms) {

                # Verify the user by verification code
                $verify_result = $this->registerService->verify($user, $request['code']);

                if($verify_result === true)
                {
                    # Generate new password
                    $new_password = Str::randomPassword();

                    # Set generated password on the user record
                    $this->registerService->setNewPassword($user, $new_password);

                    # Send generated password to the user by SMS
                    $sms_result = $sms
                                    ->setUser($user)
                                    ->setTemplate(SMSTemplate::KAVENEGAR_PASSWORD)
                                    ->setToken($new_password)
                                    ->lookup();

                    // file_put_contents(storage_path('logs/sms_logs.txt'), $sms_result . PHP_EOL . PHP_EOL, FILE_APPEND);
                    file_put_contents(storage_path('logs/sms_logs.txt'), $new_password . PHP_EOL . PHP_EOL, FILE_APPEND);

                    # Login user by id
                    Auth::loginUsingId($user->id);


                    $response_data = [
                        'data' => [
                            'redirect' => route('admin.home.index'),
                        ],
                    ];
                    return new SuccessResponse('status', null, $response_data);
                }
                else
                {
                    return new FailedResponse('status', RegisterStatusType::getValue(RegisterStatusType::REGISTER_STATUS_WRONG_TOKEN));
                    # Redirect to send token page by error.
                    // return redirect()->route('register.send-token')->withInput()->with('status', RegisterStatusType::getValue(RegisterStatusType::REGISTER_STATUS_WRONG_TOKEN));
                }

                // return redirect()->route('register.send-token');
            });
        }
        else
        {
            return new FailedResponse('status', RegisterStatusType::getValue(RegisterStatusType::REGISTER_STATUS_USER_NOT_FOUND));
        }
    }


    /**
     * showCompleteInfo
     *
     * @return view
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function showCompleteInfo()
    {
        $user = Auth::user();

        if($user->isCompleteRegister())
        {
            abort(403);
        }

        $data = [
            'user' => $user,
            'genders' => UserGenderType::getValues(),
            'nationalities' => UserNationalityType::getValues(),
        ];

        return view('auth.register.complete_info', $data);
    }


    /**
     * completeInfo
     *
     * @param CompleteRegisterRequest $request
     * @return redirect
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function completeInfo(CompleteRegisterRequest $request)
    {
        $user = Auth::user();

        if($user->isCompleteRegister())
        {
            abort(403);
        }

        $gregorian = $request['gregorian'];

        $month = Month::find($request['month']);

        if($gregorian)
        {
            # Cast selected Gregorian date to Carbon format.
            $birthday = DateTimeService::toCarbon($request['year'], $month->number, $request['day']);
            $gregorian = true;
        }
        else
        {
            /*
            * Convert Jalali selected date to Gregorian date
            * After convert to Gregorian, cast the date to Carbon format.
            */
            $birthday = DateTimeService::toGregorian($request['year'], $month->number, $request['day'], true);
            $gregorian = false;
        }

        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $first_name_en = $request['first_name_en'];
        $last_name_en = $request['last_name_en'];
        $nationality = $request['nationality'];
        $gender = $request['gender'];
        $email = $request['email'] ?? null;
        $image = $request['image'] ? ImageService::makeFromBase64($request['image'], $user) : $user->image;

        $this->registerService->completeRegister($user, $first_name, $last_name, $first_name_en, $last_name_en, $gender, $nationality, $birthday, $gregorian, $email, $image);

        return redirect('cp');
    }
}
