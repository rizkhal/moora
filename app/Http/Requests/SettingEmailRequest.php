<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingEmailRequest extends FormRequest
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
            'host' => ['required'],
            'port' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'encryption' => ['required'],
            'from_name' => ['required'],
            'from_address' => ['required'],
        ];
    }
}
