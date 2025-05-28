<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ServiceButton extends Component
{
    public $button;

    public function __construct($button = null)
    {
        $this->button = $button;
    }

    public function render()
    {
        return view('components.service-button');
    }
}