<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    /** @var string|null */
    public $color;
    public $title;
    public $value;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color, $title, $value)
    {
        $this->color = $color;
        $this->title = $title;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }
}
