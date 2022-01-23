<?php

namespace App\Http\Requests;

use App\Models\Criteria;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Http\FormRequest;

class CompleteRegistrationRequest extends FormRequest
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

    public function attributes(): array
    {
        return [
            'phone' => 'nomor hp',
            'gender' => 'jenis kelamin',
            'picture' => 'pas foto',
        ];
    }

    public function criteriaOption(): array
    {
        return array_filter(collect($this->validateCriteria())->keys()->mapWithKeys(function ($value) {
            return [$value => $this->{$value} instanceof UploadedFile ? null : $this->{$value}];
        })->all(), fn ($value): bool => $value != null);
    }

    public function validateCriteria(): array
    {
        return Criteria::all(['name', 'allow_file_upload'])->mapWithKeys(
            fn ($value) => [
                Str::replace(' ', '_', Str::lower($value->name)) => ['required'],
                Str::replace(' ', '_', Str::lower(Str::title($value->name)) . '_file') => [Rule::requiredIf($value->allow_file_upload), $value->allow_file_upload ? 'mimetypes:application/pdf' : '']
            ]
        )->all();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge([
            'nik' => ['required'],
            'gender' => ['required', 'in:0,1'],
            'picture' => ['required', 'mimes:jpg,png'],
            'phone' => ['required', 'integer', 'unique:user_details'],
        ], $this->validateCriteria());
    }

    public function commonValidatedData(): array
    {
        return [
            'nik' => $this->nik,
            'phone' => $this->phone,
            'gender' => $this->gender,
        ];
    }

    public function unValidate(): array
    {
        return array_merge(array_keys($this->commonValidatedData()), ['name', 'email', 'picture']);
    }

    public function groupCriteriaRequest(array $value): array
    {
        $texts = [];
        $files = [];

        foreach ($value as $key => $v) {
            if (Str::endsWith($v, 'file')) {
                $files[] = $v;
            } else {
                $texts[] = $v;
            }
        }

        return ['texts' => $texts, 'files' => $files];
    }

    public function getDynamicCriteria(): array
    {
        $filtered = Arr::except(request()->all(), $this->unValidate());

        return $this->groupCriteriaRequest(array_keys($filtered));
    }
}
