<?php

namespace App\Http\Livewire\Criteria;

use App\Models\Criteria;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Form extends Component
{
    /** @var string */
    public $name;
    public $attribute;

    /** @var array */
    public $row;
    public $attr;
    public $fields = [];
    public $values = [];

    public function mount($row = null)
    {
        if ($row) {
            $this->name = $row->name;
            $this->attribute = $row->attribute;
            $row->sub_criteria->each(function ($q) {
                $this->fields[] = $q->name;
                $this->values[] = $q->weight;
            });
        }
    }

    public function resetValues(): void
    {
        $this->name = null;
        $this->fields = [];
        $this->values = [];
        $this->attribute = null;
    }

    public function addField(): void
    {
        array_push($this->fields, []);
        array_push($this->values, []);
    }

    public function removeField(string $key): void
    {
        unset($this->fields[$key]);
        unset($this->values[$key]);
    }

    protected function validator()
    {
        return $this->validate([
            'name' => ['required'],
            'fields.*' => ['required'],
            'values.*' => ['required'],
            'attribute' => ['required']
        ]);
    }

    public function save()
    {
        $this->validator();

        try {
            $criteria = Criteria::create([
                'name' => $this->name,
                'attribute' => $this->attribute,
                'created_by' => Auth::id(),
            ]);

            foreach ($this->fields as $key => $value) {
                $criteria->sub_criteria()->create([
                    'name' => $this->fields[$key],
                    'weight' => $this->values[$key],
                ]);
            }

            $this->resetValues();

            $this->dispatchBrowserEvent('flash', [
                'color' => 'green',
                'message' => 'Berhasil menambah kriteria'
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function update($id)
    {
        $this->validator();

        try {
            $query = Criteria::query()->where('id', $id)->first();
            $query->update([
                'name' => $this->name,
                'attribute' => $this->attribute
            ]);

            $query->sub_criteria()->delete();
            foreach ($this->fields as $key => $value) {
                $query->sub_criteria()->create([
                    'name' => $this->fields[$key],
                    'weight' => $this->values[$key],
                ]);
            }

            $this->dispatchBrowserEvent('flash', [
                'color' => 'green',
                'message' => 'Berhasil mengubah kriteria'
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.criteria.form');
    }
}
