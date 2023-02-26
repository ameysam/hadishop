<?php

namespace App\Http\Requests\Product;

use App\Constants\DBConstant;
use Illuminate\Foundation\Http\FormRequest;


class ProductAdminRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:' . DBConstant::MARIA_FIELD_STRING_SHORT_LENGTH,
            'image' => 'nullable|max:' . DBConstant::MARIA_FIELD_STRING_LARGER_LENGTH,
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|max:65000',
            'price' => 'required|numeric|min:0',
            'available' => 'required|numeric|in:0,1',
            'special' => 'required|numeric|in:0,1',
            'suggest' => 'required|numeric|in:0,1',

        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'نام',
            'image' => 'تصویر',
            'category_id' => 'دسته‌بندی',
            'description' => 'توضیحات',
            'price' => 'قیمت',
            'available' => 'موجودی',
            'special' => 'وضعیت ویژه',
            'suggest' => 'وضعیت پیشنهاد',
        ];
    }
}
