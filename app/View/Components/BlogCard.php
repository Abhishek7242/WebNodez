<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BlogCard extends Component
{
    public $image;
    public $category;
    public $title;
    public $excerpt;
    public $date;
    public $link;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($image, $category, $title, $excerpt, $date, $link)
    {
        $this->image = $image;
        $this->category = $category;
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blog-card');
    }
}
