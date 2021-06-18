<?php

namespace Dizatech\Tag\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Dizatech\Tag\Facades\TagFacade;

class TagEdit extends Component
{
    public $tag;
    /**
     * TagForm constructor.
     * @param $tag
     */
    public function __construct($tag)
    {
        $this->tag = TagFacade::findById($tag);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('tag::components.component.tag_edit_form');
    }
}
