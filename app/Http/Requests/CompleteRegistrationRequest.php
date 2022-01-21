<?php

namespace App\Http\Requests;

use App\Models\Criteria;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\FileBag;

class CompleteRegistrationRequest extends FormRequest
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
        return Criteria::all('name')->mapWithKeys(
            fn ($value) => [
                Str::replace(' ', '_', Str::lower($value->name)) => ['required'],
                Str::replace(' ', '_', Str::lower(Str::title($value->name)) . '_file') => ['required', 'mimetypes:application/pdf']
            ]
        )->all();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge([
            'nik' => ['required', 'integer'],
            'gender' => ['required', 'in:0,1'],
            'picture' => ['required', 'mimes:jpg,png'],
            'phone' => ['required', 'integer', 'unique:user_details'],
        ], $this->validateCriteria());
    }

    public function common()
    {
        return [
            'nik' => $this->nik,
            'phone' => $this->phone,
            'gender' => $this->gender,
        ];
    }
}
