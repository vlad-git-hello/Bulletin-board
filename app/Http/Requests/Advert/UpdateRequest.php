<?php

namespace App\Http\Requests\Advert;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:250',
            'overview' => 'required|string|min:10',
            'price' => "required|regex:/^\d+$/",
            'state' => 'required',
            'type_author' => 'required',
            'category_id' => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Введите название.',
            'title.max' => 'Название слишком длинное.',
            'title.min' => 'Название слишком короткое.',
            'overview.required' => 'Введите описание.',
            'overview.min' => 'Описание слишком короткое.',
            'price.required' => 'Введите цену.',
            'category_id.required' => 'Категория не выбрана.',
            "category_id.regex:/^\d+$/" => 'Не верный формат.',
        ];
    }
}
