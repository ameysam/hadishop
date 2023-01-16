<?php

namespace App\Http\Requests\User;

use App\Constants\DBConstant;
use App\Constants\Types\User\UserActivationStatusType;
use App\Constants\Types\User\UserActivationType;
use App\Constants\Types\User\UserGenderType;
use App\Models\Month;
use App\Models\User;
use App\Rules\ForeignersIDNo;
use App\Rules\Mobile;
use App\Rules\NationalNo;
use App\Rules\OnlyEnglishString;
use App\Services\DateTime\DateTimeComponentsConvertService;
use App\Services\DateTime\DateTimeService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Str;
use Morilog\Jalali\CalendarUtils;

class UserAdminRequest extends FormRequest
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

        $user_id = Router::getParam('id');

        $rules = [
            'first_name' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH,
            'last_name' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH,
            'gender' => 'required|in:' . implode(',', UserGenderType::getValues('keys')),
            'activation_status' => 'required|in:' . implode(',', UserActivationStatusType::getValues('keys')),
            'activation_type' => 'required|in:' . implode(',', UserActivationType::getValues('keys')),
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:province_cities,id',
        ];

        if($request['password'])
        {
            $rules['password'] = "required|confirmed|min:4";
            $rules['password_confirmation'] = "required";
        }

        if($request->isMethod('put'))
        {
            $rules['email'] = 'nullable|email|unique:users,email,' . $user_id . '|max:' . DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH;
            $rules['id_no'] = ["required", "unique:users,id_no,{$user_id}", new NationalNo()];
            $rules['mobile_no'] = ["required", "unique:users,mobile_no,{$user_id}", new Mobile()];

            if($request['password'])
            {
                $rules['password'] = "required|confirmed|min:4";
            }
        }
        else
        {
            $rules['email'] = 'nullable|email|unique:users,email|max:' . DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH;
            $rules['id_no'] = ["required", "unique:users,id_no", new NationalNo()];
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
            'activation_status' => 'وضعیت',
            'activation_type' => 'نوع فعال سازی',
        ];
    }
}
