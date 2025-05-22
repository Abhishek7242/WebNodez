<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProcessStep extends Component
{
    public $number;
    public $title;
    public $description;

    /**
     * Create a new component instance.
     *
     * @param  int     $number
     * @param  string  $title
     * @param  string  $description
     */
    public function __construct($number, $title, $description)
    {
        $this->number = $number;
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
