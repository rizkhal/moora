<?php

namespace App\Http\Livewire\Criteria;

use App\Models\Criteria;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    /** @var string */
    public $name;
    public $attribute;

    /** @var array */
    public $attr;
    public $fields = [];
    public $values = [];

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

    public function save()
    {
        $this->validate([
            'name' => ['required'],
            'fields.*' => ['required'],
            'values.*' => ['required'],
            'attribute' => ['required']
        ]);

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

        // reset value
        $this->resetValues();

        $this->dispatchBrowserEvent('flash', [
            'color' => 'green',
            'message' => 'Berhasil menambah kriteria'
        ]);
    }

    public function render()
    {
        return view('livewire.criteria.create');
    }
}
