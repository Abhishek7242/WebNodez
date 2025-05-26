<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ServiceCard extends Component
{
    public $title, $description, $link, $img1, $img2;

    public function __construct($title, $description, $link = '#', $img1='', $img2='')
    {
        $this->title = $title;
        $this->description = $description;
        $this->link = $link;
        $this->img1 = $img1;
        $this->img2 = $img2;
    }

    public function render()
    {
        return view('components.services');
    }
}
