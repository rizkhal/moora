<?php

namespace App\Http\Livewire\Participan;

use App\Models\Result as ResultModel;
use Livewire\Component;

class Result extends Component
{
    /** @var array */
    public $calculates;

    /** @var object */
    public $query;

    /** @var boolean */
    public $deleteModal = false;

    public function openModalDelete(string $id)
    {
        $this->deleteModal = true;
    }

    public function deleteResult()
    {
        $this->query->delete();
    }

    public function render()
    {
        return view('livewire.participan.result');
    }
}
