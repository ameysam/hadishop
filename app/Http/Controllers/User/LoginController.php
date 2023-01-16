<?php

namespace App\Http\Controllers\User;

use App\Constants\Types\Auth\LoginStatusType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterFindUserRequest;
use App\Http\Responses\FailedResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Country;
use App\Services\User\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * @var AuthService
     */
    private $authService;

    /**
     * @var string
     */
    private $username_field;

    /**
     * __construct
     * @param AuthService $authService
     * @return void
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function __construct(AuthService $authService)
    {
        $this->username_field = 'id_no';

        # set service object and set the username field name on it.
        $this->authService = $authService->setUsername($this->username_field);
    }


    /**
     * showLoginForm
     * @return view
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function showLoginForm()
    {
        $data = [
            'countries' => Country::all(),
        ];

        return view('auth.login.login', $data);
    }

    /**
     * showLoginForm
     * @return view
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function step2()
    {
        return view('auth.login.step2');
    }


    /**
     * findUser
     * @param RegisterFindUserRequest $request
     * @return mixed
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function findUser(RegisterFindUserRequest $request)
    {
        $full_id_no = "{$request['step1-code']}-{$request['id_no']}";

        #fetch the user by username value
        $user = $this->authService->existsUsername($full_id_no);


        if($user)
        {
            # set username value in a session
            session(['id_no' => $full_id_no]);

            $response_data = [
                'data' => [
                    'username' => $full_id_no,
                ],
            ];
            return new SuccessResponse('status', null, $response_data);
        }
        else
        {
            return new FailedResponse('status', LoginStatusType::getValue(LoginStatusType::LOGIN_STATUS_USERNAME_NOT_FOUND));
        }
    }


    /**
     * login
     * @param UserRequest $request
     * @return void
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function login(LoginRequest $request)
    {
        $credentials = [
            'id_no' => $request['step2-id_no'],
            'password' => $request['password'],
        ];

        if ($this->authService->attemptToLogin($credentials)) {
            // Authentication passed...

            $response_data = [
                'data' => [
                    'redirect' => route('admin.home.index'),
                ],
            ];
            return new SuccessResponse('status', null, $response_data);
        }

        return new FailedResponse('status', LoginStatusType::getValue(LoginStatusType::LOGIN_STATUS_LOGIN_FAILED));
    }
}
