<?php

namespace App\Http\Livewire\Weight;

use App\Constants\Gender;
use App\Constants\Religion;
use App\Models\User;
use App\Services\Regional;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class Table extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Nama', 'name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Nomor Hp', 'phone')
                ->sortable()
                ->searchable(),
            Column::make('JK', 'gender')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return Gender::label($value);
                }),
            Column::make('Tanggal Lahir', 'birth_date')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    $date = format_date($value);
                    return "{$row->birth_place}, {$date}";
                }),
            Column::make('Agama', 'religion')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return Religion::label($value);
                }),
            Column::make('Alamat', 'province')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return $value;
                    // sangat clean code wkwkw
                    // return ucfirst(strtolower(Regional::province($value)['name']))
                    //     . ", " . ucfirst(strtolower(Regional::city($row->city)['name']))
                    //     . ", " . ucfirst(strtolower(Regional::district($row->district)['name']))
                    //     . ", " . ucfirst(strtolower(Regional::subdistrict($row->sub_district)['name']));
                }),
        ];
    }

    public function query(): Builder
    {
        return User::query()->withoutAdmin();
    }
}
