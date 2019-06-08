<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Repositories\TagRepository;
use App\Tag;
use Illuminate\Http\Request;
use XblogConfig;

class TagController extends Controller
{
    public $tagRepository;

    /**
     * TagController constructor.
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags',
        ]);

        if ($this->tagRepository->create($request)) {
            $this->tagRepository->clearCache();
            return back()->with('success', 'Tag' . $request['name'] . 'Created successfully');
        } else
            return back()->with('error', 'Tag' . $request['name'] . 'Creation failed');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags',
        ]);

        if ($this->tagRepository->update($request, $tag)) {
            return redirect()->route('admin.tags')->with('success', 'label' . $request['name'] . 'Successfully modified');
        }

        return back()->withInput()->withErrors('classification' . $request['name'] . 'fail to edit');
    }

    public function destroy(Tag $tag)
    {
        if ($tag->posts()->withoutGlobalScopes()->count() > 0) {
            return redirect()->route('admin.tags')->withErrors($tag->name . 'There are articles below, you can\'t delete');
        }
        if ($tag->delete()) {
            $this->tagRepository->clearCache();
            return back()->with('success', $tag->name . 'successfully deleted');
        }
        return back()->withErrors($tag->name . 'failed to delete');
    }
}
