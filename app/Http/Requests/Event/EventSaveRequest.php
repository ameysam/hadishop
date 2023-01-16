<?php

namespace App\Http\Requests\Event;

use App\Constants\DBConstant;
use App\Constants\Types\Event\EventPeriodicType;
use App\Models\Meeting;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Router;
use Illuminate\Validation\Rule;


class EventSaveRequest extends FormRequest
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
        // $center_id = Router::getParam('cid');

        $request = request();

        $rules = [
            'name' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH,
            'color' => 'nullable|max:' . DBConstant::MARIA_FIELD_STRING_SHORTEST_LENGTH,
            'description' => 'nullable|string|max:1000',
            'users' => 'nullable|array',
            // 'users.*' => 'nullable|exists:users,id',
            // 'roles' => 'nullable|array',
            'day' => 'required|date|date_format:Y-m-d',
            'started_time' => 'required|date_format:H:i',
            'finished_time' => 'nullable|date_format:H:i|after:started_time',
            'periodic_type' => 'nullable|in:' . implode(',', EventPeriodicType::getValues('keys')),
            'step_count' => 'nullable',
            'room_id' => 'nullable|exists:rooms,id',
            // 'roles_id.*' => [
            //     'nullable',
            //     Rule::exists('roles', 'id')->where(function ($query) use ($center_id) {
            //         $query->where('center_id', $center_id);
            //     }),
            // ],
        ];

        if($request['periodic_type'] != '0')
        {
            $rules['step_count'] = 'required|numeric|min:1|max:' . floor((365/$request['periodic_type'])-1);
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'room_id' => 'مرکز و اتاق',
            'schedule_id' => 'زمان‌بندی',
            'day' => 'روز',
            'name' => 'نام رویداد',
            'step_count' => 'تعداد تکرار',
            'started_time' => 'ساعت شروع',
            'finished_time' => 'ساعت پایان',
            'periodic_type' => 'دوره‌ای',
        ];
    }


    public function messages()
    {
        return [
            'room_id.required' => 'فیلد «:attribute» را انتخاب کنید.',
            'schedule_id.required' => 'فیلد «:attribute» را انتخاب کنید.',
            'step_count.max' => 'فیلد «:attribute» بیشتر از یک سال است.',
        ];
    }
}
