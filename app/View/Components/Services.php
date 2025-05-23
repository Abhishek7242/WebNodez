<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ServiceCard extends Component
{
    public $title, $description, $link, $icon;

    public function __construct($title, $description, $link = '#', $icon = '')
    {
        $this->title = $title;
        $this->description = $description;
        $this->link = $link;
        $this->icon = $icon;
    }

    public function render()
    {
        return view('components.services');
    }
}
