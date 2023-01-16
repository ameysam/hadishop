<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Types\User\UserActivationStatusType;
use App\Constants\Types\User\UserActivationType;
use App\Events\User\SignUpEvent;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function create()
    {
        $data = [
            'url' => route('register.store'),
            'activation_types' => UserActivationType::getValues(),
        ];
        return view('register', $data);
    }


    public function store(RegisterRequest $request)
    {
        $data = $request->post();

        unset($data['password_confirmation'], $data['_token']);

        return DB::transaction(function () use ($data) {

            $user = User::create($data);

            SignUpEvent::dispatch($user);

            $message = ['ثبت نام شما با موفقیت انجام شد،'];

            if($user->isActivationEmail())
            {
                $message[] = " جهت فعال‌سازی حساب کاربری به پست الکترونیک خود مراجعه نمایید.";
            }

            return redirect()
                    ->route('message')
                    ->with('status', 'success')
                    ->with('message', implode(' ', $message));
            });
    }


    public function activationByEmail(string $token)
    {
        $user = User::whereActivationEmail()
                        ->whereActivationToken($token)
                        ->whereUnActive()
                        ->first();

        if($user)
        {
            $user->activation_status = UserActivationStatusType::USER_ACTIVATION_STATUS_ACTIVE;
            $user->activation_token = Str::randomCode(60);
            $user->save();

            return redirect()
                ->route('message')
                ->with('status', 'success')
                ->with('message', 'حساب کاربری شما فعال شد.');
        }
        else
        {
            return redirect()
                ->route('message')
                ->with('status', 'danger')
                ->with('message', 'کد فعال سازی نادرست است.');
        }
    }

}
