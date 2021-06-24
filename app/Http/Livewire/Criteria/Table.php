<?php

namespace App\Http\Livewire\Criteria;

use App\Constants\Attribute;
use App\Models\Criteria;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CriteriaRequest;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class Table extends DataTableComponent
{
    /** @var object */
    public $query;

    /** @var string|null */
    public $title;
    public $code;
    public $name;
    public $weight;
    public $attribute;

    /** @var array */
    public $attr;

    /** @var bool */
    public $modalState;
    public $createModal = false;
    public $deleteModal = false;

    public array $bulkActions = [
        'openModalCreate' => 'Tambah',
    ];

    // keep clean url when request
    // if not, after modal open
    // url has been reset to root
    protected $queryString = [];

    public function resetValue(): void
    {
        $this->code = null;
        $this->name = null;
        $this->weight = null;
        $this->attribute = null;
    }

    public function openModalCreate($id = null)
    {
        if (is_null($id)) {
            $this->title = "Tambah kriteria";
            $this->resetValue();
            // set modal state true
            // for update mode
            $this->modalState = true;
            $this->createModal = true;
            return;
        }

        // set modal state false
        // for insert mode
        $this->modalState = false;

        $this->query = $this->query()->whereId($id)->first();

        $this->code = $this->query->code;
        $this->name = $this->query->name;
        $this->weight = $this->query->weight;
        $this->attribute = $this->query->attribute;

        $this->createModal = true;
    }

    public function saveCriteria()
    {
        $request = new CriteriaRequest;

        $validated = $this->validate($request->rules(), [], $request->attributes());
        try {
            $query = $this->query()->create(array_merge($validated, [
                'created_by' => Auth::id(),
            ]));

            // reset and close modal
            $this->createModal = false;
            $this->resetValue();

            $this->dispatchBrowserEvent('flash', [
                'color' => 'green',
                'message' => "Berhasil menambah kriteria {$query->name}"
            ]);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('flash', [
                'color' => 'red',
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function updateCriteria()
    {
        $request = new CriteriaRequest;

        $validated = $this->validate($request->rules(), [], $request->attributes());
        try {
            $query = $this->query->update($validated);

            // reset and close modal
            $this->createModal = false;
            $this->resetValue();

            $this->dispatchBrowserEvent('flash', [
                'color' => 'green',
                'message' => "Berhasil mengubah kriteria {$this->query->name}"
            ]);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('flash', [
                'color' => 'red',
                'message' => $th->getMessage(),
            ]);
        }
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
            Column::make('Kode', 'code')
                ->sortable()
                ->searchable(),
            Column::make('Nama', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Attribute', 'attribute')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return Attribute::label($value);
                }),
            Column::make('Bobot', 'weight')
                ->sortable()
                ->searchable(),
            Column::make('Aksi')
                ->format(function ($value, $column, $row) {
                    return view('livewire.criteria.action', ['row' => $row]);
                }),
        ];
    }
}
