<?php

namespace App\Http\Requests\Room;

use App\Constants\DBConstant;
use App\Constants\Types\Meeting\MeetingPeriodicType;
use App\Models\Meeting;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Router;
use Illuminate\Validation\Rule;


class RoomTimingRequest extends FormRequest
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
        $center_id = Router::getParam('cid');

        return [
            'name' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH,
            'color' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_SHORTEST_LENGTH,
            'description' => 'nullable|string|max:1000',
            'users' => 'nullable|array',
            'users.*' => 'nullable|exists:users,id',
            'roles' => 'nullable|array',
            'secretary_id' => 'nullable|exists:users,id',
            'day' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'started_time' => 'required|date_format:H:i',
            'finished_time' => 'required|date_format:H:i|after:started_time',
            'periodic_type' => 'nullable|in:' . implode(',', MeetingPeriodicType::getValues('keys')),
            'roles_id.*' => [
                'nullable',
                Rule::exists('roles', 'id')->where(function ($query) use ($center_id) {
                    $query->where('center_id', $center_id);
                }),
            ],
        ];
    }


    public function withValidator($validator)
    {
        $request = request();

        $validator->after(function ($validator) use ($request) {
            $room = Room::with('schedule','center')->findOrFail(Router::getParam('id1'));
            $center = $room->center;
            $schedule = $room->schedule;
            $scheduleDetailsCount = $room->schedule->details()->whereDate('started_at', $request['day'])->count();
            if($scheduleDetailsCount == 0)
            {
                $validator->errors()->add('selected_duration', 'زمان انتخاب شده درست نیست.');
                return;
            }

            $meetings = Meeting::whereCenter($center)->whereActive()->where('day', $request['day']);

            if($request->method() == 'PUT')
            {
                $meetings->where('id', '!=', Router::getParam('id2'));
            }

            $meetings = $meetings->get();

            $started_time = Carbon::parse($request['started_time']);
            $finished_time = Carbon::parse($request['finished_time']);
            foreach($meetings as $item)
            {
                $tmp_started_time = Carbon::parse($item->started_time);
                $tmp_started_time_minus_gap = (Carbon::parse($item->started_time))->addMinutes(-$schedule->gap_duration);

                $tmp_finished_time = (Carbon::parse($item->finished_time));
                $tmp_finished_time_plus_gap = (Carbon::parse($item->finished_time))->addMinutes($schedule->gap_duration);

                if($started_time->gte($tmp_started_time) && $started_time->lt($tmp_finished_time_plus_gap))
                {
                    $validator->errors()->add('selected_duration', 'زمان انتخاب شده دارای تداخل است.');
                    break;
                }
                else if($finished_time->gt($tmp_started_time_minus_gap) && $finished_time->lte($tmp_finished_time))
                {
                    $validator->errors()->add('selected_duration', 'زمان انتخاب شده دارای تداخل است.');
                    break;
                }
            }

            if($started_time->diffInMinutes($finished_time) > $schedule->reserve_duration)
            {
                $validator->errors()->add('selected_duration', 'زمان انتخاب شده درست نیست.');
            }
        });
    }

    public function attributes()
    {
        return [
            'room_id' => 'اتاق',
            'schedule_id' => 'زمان‌بندی',
            'day' => 'روز',
            'started_time' => 'ساعت شروع',
            'finished_time' => 'ساعت پایان',
            'secretary_id' => 'دبیر',
            'periodic_type' => 'دوره‌ای',
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
