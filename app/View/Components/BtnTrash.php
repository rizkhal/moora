<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BtnTrash extends Component
{
    public $row;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($row)
    {
        $this->row = $row;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.btn-trash');
    }
}
