<?php

namespace Dizatech\Tag\View\Components;

use Illuminate\View\Component;

class Tag extends Component
{
    /**
     * The label of input for search tags
     * @var $label
     */
    public $label;

    /**
     * The name of input for store tags
     * @var $name
     */
    public $name;

    /**
     * The type of page, create or edit
     * @var $page
     */
    public $page;

    /**
     * The id of model for select tags in edit pages
     * @var $id
     */
    public $id;

    /**
     * The model of object for find tags
     * @var
     */
    public $model;

    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param string $name
     * @param string $page
     * @param null $id
     * @param null $model
     */
    public function __construct($label = 'برچسب‌ها', $name = 'tags', $page = 'create',  $id = null, $model = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->page = $page;
        $this->id = $id;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // Create page
        if ($this->page = 'create' && is_null($this->id)) {
            return view('tag::components.tag.tag_create');
        }

        // Edit page
        $tags = [];
        if ($this->model::query()->where('id', '=', $this->id)->exists()) {
            $tags = $this->model::query()->find($this->id)->tags;
        }
        return view('tag::components.tag.tag_edit', [
            'tags' => $tags
        ]);
    }
}
