<?php

namespace App\Http\Requests\Meeting;

use App\Constants\Types\MeetingUser\MeetingUserStatusPredictedType;
use Illuminate\Foundation\Http\FormRequest;

class MeetingPredictRequest extends FormRequest
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
            'status' => 'required|in:' . implode(',', MeetingUserStatusPredictedType::getValues('keys')),
        ];
    }


    public function messages()
    {
        return [
            'status.in' => "«:attribute» را درست انتخاب کنید.",
        ];
    }

    public function attributes()
    {
        return [
            'status' => 'وضعیت شرکت کردن',
        ];
    }
}
