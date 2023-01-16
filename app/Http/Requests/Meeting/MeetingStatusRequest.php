<?php

namespace App\Http\Requests\Meeting;

use App\Constants\Types\Meeting\MeetingStatusType;
use Illuminate\Foundation\Http\FormRequest;

class MeetingStatusRequest extends FormRequest
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
            'status' => 'required|in:' . implode(',', MeetingStatusType::getValues('keys')),
        ];
    }

    public function attributes()
    {
        return [
            'status' => 'وضعیت',
        ];
    }
}
