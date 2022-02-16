<?php

namespace App\Http\Requests;

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

    public function attributes()
    {
        return [
            'permissionChecked' => 'permission',
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
            'name' => ['required', Rule::unique('roles', 'name')->ignore(request()->get('id'))],
            'description' => ['nullable'],
            'permissionChecked' => ['required'],
        ];
    }

    public function role()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

    public function permissions()
    {
        return [
            'permissions' => $this->permissionChecked
        ];
    }
}
