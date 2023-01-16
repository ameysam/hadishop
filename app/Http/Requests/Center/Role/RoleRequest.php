<?php

namespace App\Http\Requests\Center\Role;

use App\Constants\Types\Permission\PermissionType;
use App\Rules\OnlyEnglishString;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class RoleRequest extends FormRequest
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
            'slug' => 'required|max:191|regex:/^[a-z]+(\-?[a-z]+)$/',
            'title' => 'required|max:191',
            'permissions' => 'required|array',
            'permissions.*' => [
                'required',
                Rule::exists('permissions', 'id')->where(function ($query) {
                    $query->where('type', PermissionType::PERMISSION_CENTER);
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'slug.regex' => 'فیلد «:attribute» تنها می تواند شامل "حروف انگلیسی" و "خط فاصله(-)" باشد.',
        ];
    }

    public function attributes()
    {
        return [
            'slug' => 'نام',
            'title' => 'عنوان',
            'permissions' => 'دسترسی ها',
            'permissions.*' => 'دسترسی ها',
        ];
    }
}
