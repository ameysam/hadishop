<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class RoomScheduleRequest extends FormRequest
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
                    $query->whereNull('schedule_id')->whereNull('deleted_at');
                }),
            ],
            'schedule_id' => [
                'required',
                Rule::exists('schedules', 'id')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
        ];
    }


    public function attributes()
    {
        return [
            'room_id' => 'اتاق',
            'schedule_id' => 'زمان‌بندی',
        ];
    }


    public function messages()
    {
        return [
            'room_id.required' => 'فیلد «:attribute» را انتخاب کنید.',
            'schedule_id.required' => 'فیلد «:attribute» را انتخاب کنید.',
        ];
    }
}
