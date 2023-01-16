<?php

namespace App\Http\Requests\User;

use App\Constants\DBConstant;
use App\Constants\Types\User\UserGenderType;
use App\Rules\Mobile;
use App\Rules\NationalNo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileUpdateRequest extends FormRequest
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

        $user = Auth::user();

        $rules = [
            'first_name' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH,
            'last_name' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH,
            'gender' => 'required|in:' . implode(',', UserGenderType::getValues('keys')),
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:province_cities,id',
            'email' => 'nullable|email|unique:users,email,' . $user->id . '|max:' . DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH,
            'id_no' => ["required", "unique:users,id_no,{$user->id}", new NationalNo()],
            'mobile_no' => ["required", "unique:users,mobile_no,{$user->id}", new Mobile()],
        ];

        if($request['password'])
        {
            $rules['password'] = "required|confirmed|min:4";
            $rules['password_confirmation'] = "required";
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
