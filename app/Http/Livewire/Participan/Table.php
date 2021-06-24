<?php

namespace App\Http\Livewire\Participan;

use App\Constants\Gender;
use App\Constants\Religion;
use App\Models\User;
use App\Services\Regional;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class Table extends DataTableComponent
{
    // keep clean url when request
    // if not, after modal open
    // url has been reset to root
    protected $queryString = [];

    public array $bulkActions = [
        'calculate' => 'Set Alternatif',
    ];

    public function calculate()
    {
        if (count($this->selectedKeys)) {
            $this->emitTo('participan.calculate', 'setAlternative', $this->selectedKeys);
        }

        $this->resetAll();
    }

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
            Column::make('Aksi')
                ->format(function ($value, $column, $row) {
                    return view('livewire.participan.action', ['row' => $row]);

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
