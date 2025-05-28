<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ServiceContent extends Component
{
    public $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('components.service-content');
    }
}