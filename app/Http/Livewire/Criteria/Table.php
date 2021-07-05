<?php

namespace App\Http\Livewire\Criteria;

use App\Constants\Attribute;
use App\Models\Criteria;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class Table extends DataTableComponent
{
    /** @var object */
    public $query;

    /** @var bool */
    public $deleteModal = false;

    public array $bulkActions = [
        'create' => 'Tambah',
    ];

    // keep clean url when request
    // if not, after modal open
    // url has been reset to "/"
    protected $queryString = [];

    public function create()
    {
        return redirect()->route('criteria.create');
    }

    public function openModalDelete($id)
    {
        $this->deleteModal = true;
        $this->query = $this->query()->whereId($id)->first();
    }

    public function deleteCriteria()
    {
        $this->query->delete();
        $this->deleteModal = false;

        $this->dispatchBrowserEvent('flash', [
            'color' => 'green',
            'message' => "Berhasil menghapus kriteria {$this->query->name}"
        ]);
    }

    public function modalsView(): string
    {
        return 'livewire.criteria.modal';
    }

    public function query(): Builder
    {
        return Criteria::query();
    }

    public function columns(): array
    {
        return [
            Column::make('Nama', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Attribute', 'attribute')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return Attribute::label($value);
                }),
            Column::make('Aksi')
                ->format(function ($value, $column, $row) {
                    return view('livewire.criteria.action', ['row' => $row]);
                }),
        ];
    }
}
