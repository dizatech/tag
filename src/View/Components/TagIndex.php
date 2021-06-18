<?php

namespace Dizatech\Tag\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use Dizatech\Tag\Facades\TagFacade;

class TagIndex extends Component
{
    public $tags;

    /**
     * TagForm constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->tags = TagFacade::paginateWithSearch($request);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('tag::components.component.tag_index_table');
    }
}
