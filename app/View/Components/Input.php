<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $type;

    public $icon;
    
    public $name;
    
    public $label;

    public $placeholder;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $icon, $name, $label, $placeholder = null)
    {
        $this->type = $type;
        $this->icon = $icon;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
