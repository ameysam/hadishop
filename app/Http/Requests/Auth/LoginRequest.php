<?php

namespace App\Http\Requests\Auth;

use App\Services\App\AppService;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'password' => 'required',
            'captcha' => AppService::inProduction() ? 'required|captcha' : '',
        ];
    }


    public function attributes()
    {
        $request = request();
        $loginBy = $request['login-by'];
        $fieldName = $loginBy == 'mobile' ? 'شماره همراه' : 'کد ملی (شماره پرسنلی)';

        return [
            'id' => $fieldName,
            'password' => 'رمزعبور',
            'captcha' => 'کد امنیتی',
        ];
    }
}
