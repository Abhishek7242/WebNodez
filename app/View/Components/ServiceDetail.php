<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HeadingDetail extends Component
{
    /**
     * The service heading data.
     *
     * @var mixed
     */
    public $serviceHeading;
    public $detailsArray;

    /**
     * Create a new component instance.
     *
     * @param mixed $serviceHeading
     * @return void
     */
    public function __construct($serviceHeading, $detailsArray)
    {
        $this->serviceHeading = $serviceHeading;
        $this->detailsArray = $detailsArray;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.service-detail');
    }
}
