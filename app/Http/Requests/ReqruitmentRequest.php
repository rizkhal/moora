<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReqruitmentRequest extends FormRequest
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
            'name' => 'required',
            'min_pass' => 'required',
            'description' => 'nullable',
            'start_at' => ['required', 'date', 'before_or_equal:end_at'],
            'end_at' => ['required', 'date', 'after_or_equal:start_at'],
        ];
    }
}
