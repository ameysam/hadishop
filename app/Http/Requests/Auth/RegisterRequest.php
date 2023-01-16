<?php

namespace App\Http\Requests\Auth;

use App\Constants\DBConstant;
use App\Constants\Types\User\UserActivationType;
use App\Rules\Mobile;
use App\Rules\NationalNo;
use App\Services\App\AppService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class RegisterRequest extends FormRequest
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

    protected function prepareForValidation(): void
    {
        $request = request();

        $this->merge([
            'mobile_no' => Str::removeCountryCodeFromMobileNo($request['mobile_no'])
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $request = request();

        $rules = [
            'first_name' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH,
            'last_name' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH,
            'mobile_no' => ['required', 'unique:users', new Mobile],
            'id_no' => ['required', 'unique:users', new NationalNo],
            'email' => 'nullable|email|unique:users,email',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:province_cities,id',
            'activation_type' => 'required|in:' . implode(',', UserActivationType::getValues('keys')),
            'password' => "required|confirmed|min:4",
            'password_confirmation' => "required",
        ];

        if($request['activation_type'] == UserActivationType::USER_ACTIVATION_EMAIL)
        {
            $rules['email'] = 'required|email|unique:users,email';
        }

        return $rules;
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
