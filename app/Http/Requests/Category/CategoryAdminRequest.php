<?php

namespace App\Http\Requests\Category;

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

class CategoryAdminRequest extends FormRequest
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
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH,
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'نام دسته‌بندی',
        ];
    }
}
