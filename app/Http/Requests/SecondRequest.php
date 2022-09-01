<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecondRequest extends FormRequest
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
            // 'length' => 'required|integer|size:100'
            'length' => 'required|numeric|size:100'
        ];
    }

    public function messages()
    {
        return [
            'length.required' => 'Поле должно быть заполнено',
            'length.numeric' => 'Введите число',
            'length.size' => 'Длина не должна превышать 100'
        ];
    }
}
