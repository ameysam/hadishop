<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Types\User\UserActivationStatusType;
use App\Constants\Types\User\UserActivationType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login', ['url' => route('login.action')]);
    }

    public function authenticate(LoginRequest $request)
    {
        $loginBy = $request['login-by'];
        $credentials = $request->only('id', 'password');

        $remember = !empty($request['remember']) ? true : false;

        $credentials["{$loginBy}_no"] = $credentials['id'];
        unset($credentials['id']);

        if($loginBy == 'mobile')
        {
            $credentials['mobile_no'] = Str::removeCountryCodeFromMobileNo($credentials['mobile_no']);
        }

        // $credentials['mobile_no']
        // dd($credentials);

        $credentials['activation_status'] = UserActivationStatusType::USER_ACTIVATION_STATUS_ACTIVE;
        if (Auth::attempt($credentials, $remember))
        {
            $request->session()->regenerate();

            return redirect()->intended('cp');
        }


        $credentials['activation_status'] = UserActivationStatusType::USER_ACTIVATION_STATUS_UNACTIVE;
        if (Auth::attempt($credentials))
        {
            Auth::logout();
            return back()->withInput()->withErrors([
                'idGhost' => "حساب کاربری شما هنوز فعال نشده است.",
                'passwordGhost' => "حساب کاربری شما هنوز فعال نشده است.",
            ]);
        }


        $fieldName = $loginBy == 'mobile' ? 'شماره همراه' : 'کد ملی (شماره پرسنلی)';

        return back()->withInput()->withErrors([
            'idGhost' => "{$fieldName} یا رمز عبور اشتباه است.",
            'passwordGhost' => "{$fieldName} یا رمز عبور اشتباه است.",
        ]);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
    {
        // if(! $request->ajax())
        // {
        //     if($user->isInactive())
        //     {
        //         Auth::logout();

        //         return redirect('/');
        //     }

        //     if(! $user->isAbleTo('admin-panel'))
        //     {
        //         abort(403);
        //         // Auth::logout();

        //         // return redirect('/');
        //     }
        // }
    }
}
