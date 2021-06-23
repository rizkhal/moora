<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PageSection extends Component
{
    /** @var string|null */
    public $icon;
    public $text;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text, $title, $icon = null)
    {
        $this->icon = $icon;
        $this->text = $text;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.page-section');
    }
}
