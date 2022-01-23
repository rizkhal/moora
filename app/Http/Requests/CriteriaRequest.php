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
            'name' => ['required', Rule::unique('criterias', 'name')->ignore(request()->get('id'))],
            'description' => ['nullable'],
            'allow_file_upload' => ['nullable'],
            'weight' => ['required'],
            'weight_type' => ['required'],
            'options.*.text' => ['required'],
            'options.*.weight' => ['required'],
        ];
    }

    public function criteria(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'allow_file_upload' => (bool)$this->allow_file_upload,
            'weight' => $this->weight,
            'weight_type' => $this->weight_type,
        ];
    }
}
