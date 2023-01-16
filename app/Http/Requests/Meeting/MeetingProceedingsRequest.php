<?php

namespace App\Http\Requests\Meeting;

use Illuminate\Foundation\Http\FormRequest;

class MeetingProceedingsRequest extends FormRequest
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
            'proceedings' => 'nullable|string|max:65000',
        ];
    }


    public function messages()
    {
        return [
            'proceedings.max' => "طول متن «:attribute» بیش از حد مجاز است.",
        ];
    }

    public function attributes()
    {
        return [
            'proceedings' => 'صورتجلسه',
        ];
    }
}
