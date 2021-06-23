<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CriteriaRequest extends FormRequest
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

    public function attributes()
    {
        return [
            'code' => 'Kode',
            'name' => 'Nama',
            'weight' => 'Bobot',
            'attribute' => 'Attribute'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => ['required'],
            'name' => ['required'],
            'weight' => ['required', 'between:0,99.99'],
            'attribute' => ['required'],
        ];
    }
}
