<?php

namespace App\Http\Requests\Role;

use App\Constants\Types\Permission\PermissionType;
use App\Constants\Types\Role\RoleType;
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
            'center_id' => 'nullable|exists:centers,id',
            'type' => 'required|in:' . implode(',', RoleType::getValues('keys')),
            'permissions' => 'required|array',
            'permissions' => 'required|exists:permissions,id',
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
            'center_id' => 'مرکز',
            'type' => 'نوع',
            'permissions' => 'دسترسی ها',
            'permissions.*' => 'دسترسی ها',
        ];
    }
}
