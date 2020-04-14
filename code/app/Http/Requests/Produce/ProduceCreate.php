<?php

namespace App\Http\Requests\Produce;

use Illuminate\Foundation\Http\FormRequest;

class ProduceCreate extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'cnpj' => 'required|min:14|max:14',
            'telephone' => 'required|min:10|max:11',
            'email' => 'required|min:8|max:255'
        ];
    }
}
