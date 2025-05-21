<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Technologies extends Component
{
    public $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function render()
    {
        return view('components.technologies');
    }
}
