<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = request()->get('id');

        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'password' => [Rule::requiredIf(fn () => !$id), Rule::when(!$id, 'min:6')],
            'passwordConfirmation' => [Rule::requiredIf(fn () => !$id), 'same:password'],
            'role' => ['required', 'integer'],
        ];
    }

    public function dataUser(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => request()->filled('password') ? Hash::make($this->password) : null,
        ];
    }
}
