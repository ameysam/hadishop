<?php

namespace App\Http\Requests\Center;

use App\Constants\DBConstant;
use App\Constants\Types\Center\CenterStatusType;
use Illuminate\Foundation\Http\FormRequest;

class CenterRequest extends FormRequest
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
            'name' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_SHORTER_LENGTH,
            'type_id' => 'required',
            'status' => 'required|in:' . implode(',', CenterStatusType::getValues('keys')),
            'contacts' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:1000',
            'admins' => 'nullable|exists:users,id',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'file' => 'nullable|file|mimes:jpg,png|max:1024',
        ];
    }

    
    public function attributes()
    {
        return [
            'name' => 'نام مرکز',
            'type_id' => 'نوع مرکز',
            'contacts' => 'اطلاعات تماس',
            'address' => 'آدرس',
            'lat' => 'پین نقشه',
            'lng' => 'پین نقشه',
            'file' => 'فایل لوگو',
            'admins' => 'مسئول مرکز',
            'status' => 'وضعیت',
        ];
    }
}
