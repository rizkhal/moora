<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $icon;
    public $label;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $icon = null)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select');
    }
}
