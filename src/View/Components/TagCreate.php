<?php

namespace Dizatech\Tag\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagCreate extends Component
{
    /**
     * TagForm constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('tag::components.component.tag_create_form');
    }
}
