<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'profile_picture' => 'pas foto',
            'ktp' => 'kartu tanda penduduk',
            'kk' => 'kartu keluarga',
            'skd' => 'surat keterangan dokter',
            'sp' => 'surat peringatan',
            'skck' => 'surat kelakuan baik',
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
            'nik' => ['required', 'integer'],
            'phone' => ['required', 'integer'],
            'gender' => ['required', 'in:0,1'],
            'profile_picture' => ['required', 'mimes:jpg,png'],
            'ktp' => ['required', 'mimetypes:application/pdf'],
            'kk' => ['required', 'mimetypes:application/pdf'],
            'skd' => ['required', 'mimetypes:application/pdf'],
            'sp' => ['required', 'mimetypes:application/pdf'],
            'skck' => ['required', 'mimetypes:application/pdf'],
        ];
    }

    public function common()
    {
        return [
            'nik' => $this->nik,
            'phone' => $this->phone,
            'gender' => $this->gender,
        ];
    }

    public function attachment(): array
    {
        return [
            'profile_picture' => $this->profile_picture,
            'ktp' => $this->ktp,
            'kk' => $this->kk,
            'skd' => $this->skd,
            'sp' => $this->sp,
            'skck' => $this->skck,
        ];
    }
}
