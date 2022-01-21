<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CriteriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'allow_file_upload' => ['nullable'],
            'options.*.text' => ['required'],
            'options.*.value' => ['required'],
            'options.*.value_type' => ['required'],
        ];
    }

    public function criteria(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'allow_file_upload' => (bool)$this->allow_file_upload,
        ];
    }
}
