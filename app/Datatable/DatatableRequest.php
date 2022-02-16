<?php

namespace App\Datatable;

use App\Datatable\Column;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DatatableRequest extends FormRequest
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
            'direction' => Rule::in(['asc', 'desc']),
            'column' => Rule::in(collect($this->columns())->pluck('column')->all())
        ];
    }

    public function getSearchableColumns(): array
    {
        return array_filter($this->columns(), fn (Column $column) => $column->isSearchable());
    }
}
