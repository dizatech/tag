<?php

namespace Dizatech\Tag\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dizatech\Tag\Facades\TagFacade;
use MoDizatechdules\Tag\Http\Requests\TagRequest;
use Dizatech\Tag\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        return view('vendor.tag.tag_index', [
            'tags' => TagFacade::paginateWithSearch($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('vendor.tag.tag_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagRequest $request
     * @return void
     */
    public function store(TagRequest $request)
    {
        $tag = TagFacade::save($request);
        session()->flash('success', 'عملیات ثبت با موفقیت انجام گردید.');
        return redirect()->route('tags.edit', $tag);
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return void
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return void
     */
    public function edit(Tag $tag)
    {
        return view('vendor.tag.tag_edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagRequest $request
     * @param Tag $tag
     * @return void
     */
    public function update(TagRequest $request, Tag $tag)
    {
        TagFacade::update($request, $tag);
        session()->flash('success', 'عملیات ثبت با موفقیت انجام گردید.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return void
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(['message' => 'عملیات حذف با موفقیت انجام شد.'], 200);
    }

    public function ajax_search_tags()
    {
        $tags = [];
        if (request()->has('q')){
            $tags = Tag::query()
                ->whereRaw("name like  ?", ['%' . request('q') . '%'])
                ->get();
        }
        $results = [];
        foreach ($tags as $tag) {
            $temp = new \stdClass();
            $temp->id = $tag->id;
            $temp->text = $tag->name ;
            $results[] = $temp;
        }
        $output = new \stdClass();
        $output->results = $results;
        return response()->json($output);
    }
}
