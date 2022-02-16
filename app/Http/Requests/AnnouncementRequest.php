<?php

namespace App\Http\Requests;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
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
            'reqruitment' => ['required'],
            'title' => ['required'],
            'content' => ['required'],
        ];
    }

    public function getData(): array
    {
        return Arr::except($this->validated(), 'reqruitment');
    }
}
