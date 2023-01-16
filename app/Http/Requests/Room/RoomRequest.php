<?php

namespace App\Http\Requests\Room;

use App\Constants\DBConstant;
use App\Constants\Types\Room\RoomType;
use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'type' => 'required|in:' . implode(',', RoomType::getValues('keys')),
            'capacity' => 'nullable|numeric|min:0|max:250',
            'description' => 'nullable|max:1000',
            'schedule_id' => 'nullable|exists:schedules,id',
        ];
    }

    
    public function attributes()
    {
        return [
            'name' => 'نام اتاق',
            'type' => 'نوع اتاق',
            'capacity' => 'ظرفیت',
            'description' => 'توضیحات',
        ];
    }

    
    public function messages()
    {
        return [
            'type.required' => 'فیلد «:attribute» را انتخاب کنید.',
        ];
    }
}
