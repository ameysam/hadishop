<?php

namespace App\Http\Requests\Schedule;

use App\Constants\DBConstant;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'name' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH,
            'dates' => 'required',
            'started_time_hr' => 'required|min:0|max:23',
            'started_time_min' => 'required|in:0,15,30,45',
            'finished_time_hr' => 'required|min:0|max:23',
            'finished_time_min' => 'required|in:0,15,30,45',
            'reserve_duration_hr' => 'required|min:0|max:23',
            'reserve_duration_min' => 'required|in:0,15,30,45',
            'gap_duration_hr' => 'required|min:0|max:23',
            'gap_duration_min' => 'required|in:0,15,30,45',
            'times_start' => 'required|array',
            'times_start.*' => 'required|date|date_format:Y-m-d H:i:s',
            'times_finish' => 'required|array',
            'times_finish.*' => 'required|date|date_format:Y-m-d H:i:s',
        ];
    }

    public function withValidator($validator)
    {
        $request = request();

        $validator->after(function ($validator) use ($request) {
            try
            {
                $temp = explode(' - ', $request['dates']);
                if(count($temp) != 2)
                {
                    $validator->errors()->add('dates', 'بازه زمانی انتخاب شده درست نیست.');
                }
            }
            catch(Exception $e)
            {
                $validator->errors()->add('dates', 'بازه زمانی انتخاب شده درست نیست.');
            }
        });
    }

    public function attributes()
    {
        return [
            'name' => 'عنوان زمان‌بندی',
            'started_time_hr' => 'ساعت شروع',
            'started_time_min' => 'دقیقه شروع',
            'finished_time_hr' => 'ساعت پایان',
            'finished_time_min' => 'دقیقه پایان',
            'reserve_duration_hr' => 'ساعت سقف رزرو',
            'reserve_duration_min' => 'دقیقه سقف رزرو',
            'gap_duration_hr' => 'ساعت فاصله هر رزرو',
            'gap_duration_min' => 'دقیقه فاصله هر رزرو',
            'times_start' => 'زمان های انتخابی',
            'times_start.*' => 'زمان های انتخابی',
            'times_finish' => 'زمان های انتخابی',
            'times_finish.*' => 'زمان های انتخابی',
        ];
    }
}
