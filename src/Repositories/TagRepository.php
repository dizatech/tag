<?php

namespace Dizatech\Tag\Repositories;

use Illuminate\Http\Request;
use Dizatech\Tag\Http\Requests\TagRequest;
use Dizatech\Tag\Models\Tag;

class TagRepository
{
    private $tag;

    /**
     * TagRepository constructor.
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function findById($id)
    {
        return Tag::query()->findOrFail($id);
    }

    public function getTags()
    {
        return Tag::query()->get();
    }

    public function paginateWithSearch($request)
    {
        if($request->has('keyword')) {
            $tags = Tag::query()->where('name', 'like', '%' . $request->keyword . '%')->latest()->paginate();
        } else {
            $tags = Tag::query()->latest()->paginate();
        }
        return $tags;
    }

    public function save($request)
    {
        $tag = $this->tag->fill($request->all());
        $tag->save();
        return $tag;
    }

    public function update($request, $tag)
    {
        $tag = $tag->fill($request->all());
        $tag->save();
    }
}
