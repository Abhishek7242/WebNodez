<?php

namespace App\View\Components;

use Illuminate\View\Component;

class WhyChooseUs extends Component
{
    public $projectNumber;
    public $clientSatis;

    public function __construct($projectNumber = 50, $clientSatis = 98)
    {
        $this->projectNumber = $projectNumber;
        $this->clientSatis = $clientSatis;
    }

    public function render()
    {
        return view('components.why-choose-us');
    }
}
