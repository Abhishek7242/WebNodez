<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProcessStep extends Component
{
    public $icon;
    public $title;
    public $description;

    /**
     * Create a new component instance.
     *
     * @param  int     $icon
     * @param  string  $title
     * @param  string  $description
     */
    public function __construct($icon, $title, $description)
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.process-step');
    }
}