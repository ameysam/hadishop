<?php

namespace App\Http\Requests\User;

use App\Constants\DBConstant;
use App\Constants\Types\User\UserGenderType;
use App\Rules\Mobile;
use App\Rules\NationalNo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Router;
use Illuminate\Support\Str;

class MemberCenterRequest extends FormRequest
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

        $user_id = Router::getParam('id1');

        $rules = [
            'first_name' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH,
            'last_name' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH,
            'gender' => 'required|in:' . implode(',', UserGenderType::getValues('keys')),
            'province_id' => 'nullable|exists:provinces,id',
            'city_id' => 'nullable|exists:province_cities,id',
        ];

        if($request['password'])
        {
            $rules['password'] = "required|confirmed|min:4";
            $rules['password_confirmation'] = "required";
        }

        if($request->isMethod('put'))
        {
            $rules['email'] = 'nullable|email|unique:users,email,' . $user_id . '|max:' . DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH;
            $rules['id_no'] = ["required", "unique:users,email,{$user_id}", new NationalNo()];
            $rules['mobile_no'] = ["required", "unique:users,mobile_no,{$user_id}", new Mobile()];

            if($request['password'])
            {
                $rules['password'] = "required|confirmed|min:4";
            }
        }
        else
        {
            $rules['email'] = 'nullable|email|unique:users,email|max:' . DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH;
            $rules['id_no'] = ["required", "unique:users,email", new NationalNo()];
            $rules['mobile_no'] = ["required", "unique:users,mobile_no", new Mobile()];
            $rules['password'] = "required|confirmed|min:4";
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'gender' => 'جنسیت',
            'proivnce_id' => 'استان',
            'city_id' => 'شهر',
        ];
    }
}
