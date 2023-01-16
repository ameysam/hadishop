<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class RoomScheduleDeleteRequest extends FormRequest
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
            'room_id' => [
                'required',
                Rule::exists('rooms', 'id')->where(function ($query) {
                    $query->whereNotNull('schedule_id')->whereNull('deleted_at');
                }),
            ],
        ];
    }

    
    public function attributes()
    {
        return [
            'room_id' => 'اتاق',
        ];
    }

    
    public function messages()
    {
        return [
            'room_id.required' => 'فیلد «:attribute» را انتخاب کنید.',
        ];
    }
}
