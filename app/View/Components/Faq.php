<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Faq extends Component
{
    public $faqs;

    public function __construct($faqs)
    {
        $this->faqs = $faqs;
    }

    public function render()
    {
        return view('components.faq', ['faqs' => $this->faqs]);
    }
}