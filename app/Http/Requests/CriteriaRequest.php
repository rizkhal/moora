<?php

namespace App\Http\Requests;

use App\Enums\CriteriaType;
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
        dd(request()->options);

        $criteria = [
            'name' => ['required'],
            'description' => ['nullable'],
            'allow_file_upload' => ['nullable'],
            'input_type' => ['required'], // text or option
        ];

        if ($this->isText()) {
            $validate = [
                'texts.label' => ['required'],
                'texts.value' => ['required'],
                'texts.value_type' => ['required'],
            ];
        }

        if ($this->isOption()) {
            $validate = [
                'options.label' => ['required'],
                'options.items.*.text' => ['required'],
                'options.items.*.value' => ['required'],
                'options.items.*.value_type' => ['required'],
            ];
        }

        return array_merge($criteria, $validate ?? []);
    }

    public function criteria(): array
    {
        return [
            'name' => $this->name,
            'input_type' => (int)$this->input_type, // text or option
            'description' => $this->description,
            'allow_file_upload' => (bool)$this->allow_file_upload,
        ];
    }

    public function isText(): bool
    {
        return (int)$this->input_type === CriteriaType::TEXT->value;
    }

    public function isOption(): bool
    {
        return (int)$this->input_type === CriteriaType::OPTION->value;
    }
}
