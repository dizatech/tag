<?php

namespace Dizatech\Tag\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name'        => ['required', 'string', 'max:512'],
            'slug'        => ['nullable', 'string', 'max:512'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام برچسب الزامی می‌باشد.',
            'name.max' => 'تعداد کاراکتر مجاز حداکثر ۵۱۲ می‌باشد.',
            'slug.max' => 'تعداد کاراکتر مجاز حداکثر ۵۱۲ می‌باشد.',
        ];
    }
}
