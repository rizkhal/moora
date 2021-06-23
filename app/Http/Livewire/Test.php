<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Test extends Component
{
    public $open;

    public function openModal()
    {
        $this->open = true;
    }
    
    public function render()
    {
        return view('livewire.test');
    }
}
